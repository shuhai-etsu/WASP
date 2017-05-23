{{--This button template is here due to the usage of bootstrap. Typically a normal css class would be made with the appropriate styling, but--}}
{{--due to CSS not allowing for specified inheritance of other classes then we have to do something more extensive.--}}

{{--No reason to use both CSS options at the same time, use one or the other with or without any of the other options.--}}
<a class="{{ $button_css_replace_default or 'btn btn-primary ' }} {{ $button_css_add or '' }}" href={{$button_link or '#'}}>{{$button_text or 'Edit'}}</a>