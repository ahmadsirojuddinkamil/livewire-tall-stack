@if(!$errors->has($field->multiple ? $field->name.'.'.$loop->index : $field->name))
    {{--avoid showing files that didn't pass validation --}}
<li class="tf-file-upload-li" wire:key="{{ md5($field->multiple ? $field->name.'.'.$loop->index : $field->name) }}">
    <div>
        {{--Temporary urls are only available for file type image--}}
        @if( \Str::startsWith($file->getMimeType(), 'image') )
            <div class="tf-file-upload-thumb-wrapper">
                <img class="tf-file-upload-thumb-img" src="{{ $file->temporaryUrl() }}" alt="{{ $file->getClientOriginalName() }}"/>
            </div>
        @else
            <div class="tf-file-upload-icon-wrapper">
                <x-tall-svg :path="$field->tall_svg_file.$fileIcon($file->getMimeType())" class="h-4 w-4 fill-current" />
            </div>
        @endif
    </div>
    <div class="flex-1 px-2">{{ $file->getClientOriginalName() }}</div>
    <button type="button" class="tf-file-upload-delete-btn"
             @if($field->confirm_delete) onclick="confirm('{{ $field->confirm_msg }}') || event.stopImmediatePropagation();" @endif
            wire:click.prevent="deleteSingleTempFile('{{ $field->name }}', '{{ isset($loop) ? $loop->index : null }}')">
        <span class="px-2" wire:loading wire:target="deleteSingleTempFile"><x-tall-spinner /></span>
        <x-tall-svg :path="$field->tall_svg_trash" class="tf-file-upload-btn-size fill-current" />
    </button>
</li>
@endif
