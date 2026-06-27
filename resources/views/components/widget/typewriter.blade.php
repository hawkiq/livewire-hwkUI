<span 
    {{ $attributes->merge(['dir' => 'auto']) }} 
    x-data="{
        words: {{ json_encode($words) }},
        text: '',
        wordIndex: 0,
        isDeleting: false,
        typeSpeed: {{ $typeSpeed }},
        deleteSpeed: {{ $deleteSpeed }},
        loop: {{ $loop ? 'true' : 'false' }},
        pauseTime: {{ $pauseTime }},
        
        init() {
            if (this.words.length > 0) {
                this.type();
            }
        },
        
        type() {
            const currentWord = this.words[this.wordIndex];
            
            if (this.isDeleting) {
                this.text = currentWord.substring(0, this.text.length - 1);
            } else {
                this.text = currentWord.substring(0, this.text.length + 1);
            }

            let delay = this.isDeleting ? this.deleteSpeed : this.typeSpeed;

            if (!this.isDeleting && this.text === currentWord) {
                delay = this.pauseTime;
                this.isDeleting = true;
                
                if (!this.loop && this.wordIndex === this.words.length - 1) {
                    return; 
                }
            } 
            else if (this.isDeleting && this.text === '') {
                this.isDeleting = false;
                this.wordIndex = (this.wordIndex + 1) % this.words.length;
                delay = 400; 
            }

            setTimeout(() => this.type(), delay);
        }
    }"
>
    <span x-text="text"></span>
    
    @if($cursor)
        <span class="animate-ping select-none mx-0.5">|</span>
    @endif
</span>