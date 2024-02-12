<div>
    <livewire:comment-create :post="$post"/>

    <div style="max-height: 300px" class="overflow-y-auto mt-5">
        @foreach($postComments as $comment)
            <livewire:comment-item  :comment="$comment" :post="$post" wire:key="comment-{{$comment->id}}" />
        @endforeach
    </div>
</div>
