<template>
    <div class="dropdown">
        <!-- trigger -->
        <div
            class="dropdown-toggle"
            aria-haspopup="true"
            :aria-expanded="isOpen"
            @click.prevent="isOpen = !isOpen"
        >
            <slot name="trigger"></slot>
        </div>
        <!-- menu links -->
        <div 
            class="dropdown-menu absolute bg-white py-2 mt-1 rounded shadow"
            :class="align === 'left' ? 'left-0' : 'right-0'"
            :style="{ width }"
            v-show="isOpen"
        >
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            width: {default: 'auto'},
            align: {default: 'left'}
        },

        data() {
            return{ isOpen: false }
        },

        watch: {
            isOpen(isOpen) {
                if(isOpen) {
                    document.addEventListener('click', this.closeIfClickedOutside);
                }
            }
        },
        
        methods: {
            closeIfClickedOutside(event) {
                if(! event.target.closest('.dropdown')) {
                    this.isOpen = false;

                    document.removeEventListener('click', this.closeIfClickedOutside);
                }
            }
        }
    }
</script>