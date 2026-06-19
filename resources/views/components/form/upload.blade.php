@php
    $wireModel = $attributes->wire('model')->value();
@endphp

<div x-data="{
    isDragging: false,
    isUploading: false,
    progress: 0,
    focused: false,
    wireModel: '{{ $wireModel }}',
    maxFiles: {{ $multiple && $max ? $max : 'null' }},
    errorMessage: '',

    init() {
        if (!this.wireModel) return;

        this.$el.addEventListener('livewire-upload-start', () => { this.isUploading = true; this.progress = 0; this.errorMessage = ''; });
        this.$el.addEventListener('livewire-upload-finish', () => { this.isUploading = false; this.progress = 0; });
        this.$el.addEventListener('livewire-upload-error', () => { this.isUploading = false; this.progress = 0; });
        this.$el.addEventListener('livewire-upload-progress', (e) => { this.progress = e.detail.progress; });

        this.$watch('$wire.' + this.wireModel, (value) => {
            if (!value || !this.maxFiles) {
                this.errorMessage = '';
                return;
            }
            let currentCount = Object.values(value).filter(file => file !== null).length;
            if (currentCount <= this.maxFiles) {
                this.errorMessage = '';
            }
        });
    },

    validateAndUpload(files) {
        this.errorMessage = '';
        if (!files || !files.length) return false;
        
        // Enforce max files limit if multiple is active and max is configured
        if (this.maxFiles && files.length > this.maxFiles) {
            this.errorMessage = '{{ __('You can only upload a maximum of') }} ' + this.maxFiles + ' {{ __('files.') }}';
            this.clearInput();
            return false;
        }

        // Proceed to upload via Livewire's JS Runtime pipeline
        if ('{{ $multiple ? 'true' : 'false' }}' === 'true') {
            @this.uploadMultiple(this.wireModel, files);
        } else {
            @this.upload(this.wireModel, files[0]);
        }
        
        this.clearInput();
    },

    clearInput() {
        if (this.$refs.fileInput) {
            this.$refs.fileInput.value = '';
        }
    }
}" class="w-full space-y-3">

    <div 
        @click="$refs.fileInput.click()"
        @keydown.enter="$refs.fileInput.click()"
        @keydown.space="$refs.fileInput.click()"
        @dragover.prevent="isDragging = true" 
        @dragleave.prevent="isDragging = false"
        @drop.prevent="isDragging = false; validateAndUpload($event.dataTransfer.files)"
        tabindex="0"
        @focus="focused = true"
        @blur="focused = false"
        class="relative flex flex-col items-center justify-center w-full p-6 border-2 border-dashed rounded-xl transition-all duration-200 min-h-40 cursor-pointer select-none outline-none"
        :class="{
            'border-indigo-500 bg-indigo-50/40 dark:bg-indigo-950/10 ring-4 ring-indigo-500/10': isDragging,
            'border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 hover:border-slate-400 dark:hover:border-slate-600': !isDragging,
            'ring-2 ring-indigo-500/20 border-indigo-500': focused,
            'border-red-500 bg-red-50/30 dark:bg-red-950/10 ring-4 ring-red-500/10': errorMessage !== ''
        }"
    >
        <input 
            x-ref="fileInput"
            type="file" 
            {{ $multiple ? 'multiple' : '' }} 
            @change="validateAndUpload($event.target.files)"
            class="hidden"
            {{ $attributes->only(['accept']) }}
        />

        <div class="text-center pointer-events-none space-y-2 z-0">
            <div class="inline-flex p-2 bg-slate-50 dark:bg-slate-800 rounded-lg text-slate-400 dark:text-slate-500"
                :class="{ 'text-red-500 bg-red-50 dark:bg-red-950/50': errorMessage !== '' }">
                <x-hwkui-icon name="exclamation-circle" class="w-6 h-6 text-red-500" x-show="errorMessage !== ''" x-cloak />
                <x-hwkui-icon name="cloud-arrow-up" class="w-6 h-6" x-show="errorMessage === ''" />
            </div>

            <div class="text-sm text-slate-600 dark:text-slate-400">
                <span class="font-semibold text-indigo-600 dark:text-indigo-400"
                    :class="{ 'text-red-600 dark:text-red-400': errorMessage !== '' }">{{ __('Click to upload') }}</span>
                {{ __('or drag and drop') }}
            </div>

            <p x-show="errorMessage !== ''" x-text="errorMessage"
                class="text-xs font-semibold text-red-600 dark:text-red-400" x-cloak></p>

            <p x-show="errorMessage === ''" class="text-xs text-slate-500 dark:text-slate-400">
                @if ($hint)
                    {{ $hint }}
                @elseif($multiple && $max)
                    {{ __('Maximum') }} {{ $max }} {{ __('files allowed') }}
                @endif
            </p>
        </div>
    </div>

    <div x-show="isUploading" x-collapse x-cloak class="space-y-1.5">
        <div class="flex justify-between text-xs font-medium text-slate-500">
            <span>Uploading file...</span>
            <span x-text="progress + '%'"></span>
        </div>
        <div class="w-full bg-slate-200 dark:bg-slate-700 h-2 rounded-full overflow-hidden">
            <div class="bg-indigo-600 h-full transition-all duration-150 ease-out rounded-full"
                :style="`width: ${progress}%`"></div>
        </div>
    </div>

    @if ($wireModel)
        @php
            $filePropertyValue = $this->getPropertyValue($wireModel);
        @endphp

        @if ($filePropertyValue)
            <div class="space-y-2 pt-1">
                @if ($multiple && is_array($filePropertyValue))
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @foreach ($filePropertyValue as $index => $file)
                            @if (is_null($file))
                                @continue
                            @endif

                            @if ($preview && method_exists($file, 'temporaryUrl') && str_starts_with($file->getMimeType(), 'image/'))
                                <div class="relative group aspect-square border border-slate-200 dark:border-slate-800 rounded-lg overflow-hidden bg-slate-100 dark:bg-slate-950">
                                    <img src="{{ $file->temporaryUrl() }}" class="object-cover w-full h-full">
                                    <button type="button"
                                        wire:click="$set('{{ $wireModel }}.{{ $index }}', null)"
                                        class="cursor-pointer absolute top-1.5 right-1.5 p-1 bg-red-600 text-white rounded-full opacity-90 hover:opacity-100 shadow">
                                        <x-hwkui-icon name="xmark" class="w-3.5 h-3.5" />
                                    </button>
                                </div>
                            @else
                                <div class="flex items-center justify-between p-2.5 text-xs border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 rounded-lg shadow-sm">
                                    <div class="flex items-center space-x-2 truncate">
                                        <x-hwkui-icon name="paperclip" class="w-4 h-4 text-slate-400 shrink-0" />
                                        <span class="truncate font-medium text-slate-700 dark:text-slate-300">{{ method_exists($file, 'getClientOriginalName') ? $file->getClientOriginalName() : 'File' }}</span>
                                    </div>
                                    <button type="button"
                                        wire:click="$set('{{ $wireModel }}.{{ $index }}', null)"
                                        class="cursor-pointer text-red-500 hover:text-red-600 ml-2">
                                        <x-hwkui-icon name="trash" class="w-4 h-4" />
                                    </button>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @elseif(!is_array($filePropertyValue))
                    @if ($preview && method_exists($filePropertyValue, 'temporaryUrl') && str_starts_with($filePropertyValue->getMimeType(), 'image/'))
                        <div class="relative group w-32 h-32 border border-slate-200 dark:border-slate-800 rounded-lg overflow-hidden bg-slate-100 dark:bg-slate-950">
                            <img src="{{ $filePropertyValue->temporaryUrl() }}" class="object-cover w-full h-full">
                            <button type="button" wire:click="$set('{{ $wireModel }}', null)"
                                class="cursor-pointer absolute top-1.5 right-1.5 p-1 bg-red-600 text-white rounded-full opacity-90 hover:opacity-100 shadow">
                                <x-hwkui-icon name="xmark" class="w-3.5 h-3.5" />
                            </button>
                        </div>
                    @else
                        <div class="flex items-center justify-between p-2.5 text-xs border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 rounded-lg shadow-sm max-w-md">
                            <div class="flex items-center space-x-2 truncate">
                                <x-hwkui-icon name="paperclip" class="w-4 h-4 text-slate-400 shrink-0" />
                                <span class="truncate font-medium text-slate-700 dark:text-slate-300">{{ method_exists($filePropertyValue, 'getClientOriginalName') ? $filePropertyValue->getClientOriginalName() : 'File' }}</span>
                            </div>
                            <button type="button" wire:click="$set('{{ $wireModel }}', null)"
                                class="cursor-pointer text-red-500 hover:text-red-600 ml-2">
                                <x-hwkui-icon name="trash" class="w-4 h-4" />
                            </button>
                        </div>
                    @endif
                @endif
            </div>
        @endif
    @endif
</div>