<template>
    <modal name="new-project" classes="p-4 pb-6 bg-white rounded-lg" height="auto">
        <form @submit.prevent="submit">
            <h1 class="text-2xl font-normal mt-2 mb-8 text-center">Let's start something new</h1>
            <div class="flex">
                <div class="flex-1 mr-3">
                    <div class="mb-3">
                        <label for="title" class="text-sm block mb-1">Title</label>
                        <input
                            type="text"
                            id="title"
                            class="border py-2 px-3 text-xs block w-full rounded"
                            :class="errors.title ? 'border border-red-700' : 'border-muted-light'"
                            name="title"
                            v-model="form.title"
                        />
                        <span class="text-xs italic text-red-700" v-if="errors.title" v-text="errors.title[0]"></span>
                    </div>
                    <div class="">
                        <label for="description" class="text-sm block mb-1">Description</label>
                        <textarea
                            name="description"
                            id="description"
                            rows="8"
                            class="border py-2 px-3 text-xs block w-full rounded"
                            :class="errors.title ? 'border border-red-700' : 'border-muted-light'"
                            v-model="form.description"
                        ></textarea>
                        <span class="text-xs italic text-red-700" v-if="errors.description" v-text="errors.description[0]"></span>
                    </div>
                </div>
                <div class="flex-1 ml-3">
                    <div class="mb-3">
                        <label class="text-sm block mb-1">Need some tasks?</label>
                        <input 
                            type="text" 
                            class="border border-muted-light py-2 px-3 text-xs block w-full rounded mb-2" 
                            name="title" 
                            placeholder="Task 1" 
                            v-for="task in form.tasks"
                            v-model="task.body"
                        />
                    </div>
                    <button type="button" class="inline-flex items-center text-xs" @click="addTask">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" class="mr-1">
                            <g fill="none" fill-rule="evenodd" opacity=".307">
                                <path stroke="#000" stroke-opacity=".012" stroke-width="0" d="M-3-3h24v24H-3z"></path>
                                <path fill="#000" d="M9 0a9 9 0 0 0-9 9c0 4.97 4.02 9 9 9A9 9 0 0 0 9 0zm0 16c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7zm1-11H8v3H5v2h3v3h2v-3h3V8h-3V5z"></path>
                            </g>
                        </svg>

                        <span>Add New Task Field</span>
                    </button>
                </div>
            </div>
            <footer class="mt-5 text-right">
                <button type="button" class="button-muted" @click="$modal.hide('new-project')">Cancel</button>
                <button type="submit" class="button">Create Project</button>
            </footer>
        </form>
    </modal>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    title: '',
                    description: '',
                    tasks: [
                        { body: '' }
                    ]
                },

                errors: {}
            };
        },

        methods: {
            addTask() {
                this.form.tasks.push({ value: '' });
            },

            submit() {
                axios.post('/projects', this.form)
                    .then(response => {
                        location = response.data.url;
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                    });
            }
        }
    }
</script>