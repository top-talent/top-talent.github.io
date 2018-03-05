@if($mime === 'image/jpeg' || $mime === 'image/png')
    <i class="fa fa-file-image-o"></i>
@elseif($mime === 'application/pdf')
    <i class="fa fa-file-pdf-o"></i>
@elseif($mime === 'application/msword' || $mime === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
    <i class="fa fa-file-word-o"></i>
@elseif($mime === 'application/vnd.ms-powerpoint' || $mime === 'application/vnd.openxmlformats-officedocument.presentationml.presentation')
    <i class="fa fa-file-powerpoint-o"></i>
@else
    <i class="fa fa-file-o"></i>
@endif
