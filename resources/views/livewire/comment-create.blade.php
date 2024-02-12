<div x-data="{
    focused: false,
    init() {
        $wire.on('commentCreated', () => {
            this.focused = false;
        })
    }
}">
    <div class="mb-3">
        <textarea @click="focused = true"  type="text"  class="px-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" cols="3" :rows="focused ? '2' : '1'" wire:model="comment" placeholder="Leave a Comment..."></textarea>
    </div>
    <div class="flex items-center gap-3" :class="focused ? 'block' : 'hidden'">
        <button wire:click="createComment()" type="button" class="flex justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>

        <button @click="focused = false" type="button" class="flex justify-center rounded-md bg-red-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Cancel</button>
    </div>
</div>
