@if($entry->level === 'error')
    <span class="label label-danger">
      <span class="fa fa-exclamation-triangle"></span> Error
    </span>
@elseif($entry->level === 'emergency')
    <span class="label label-danger">
      <span class="fa fa-exclamation-circle"></span> Emergency
    </span>
@elseif($entry->level === 'alert')
    <span class="label label-warning">
      <span class="fa fa-exclamation"></span> Alert
    </span>
@elseif($entry->level === 'critical')
    <span class="label label-danger">
      <span class="fa fa-exclamation-triangle"></span> Critical
    </span>
@elseif($entry->level === 'notice')
    <span class="label label-info">
      <span class="fa fa-info"></span> Notice
    </span>
@elseif($entry->level === 'info')
    <span class="label label-info">
      <span class="fa fa-info-circle"></span> Info
    </span>
@elseif($entry->level === 'debug')
    <span class="label label-default">
      <span class="fa fa-bell"></span> Debug
    </span>
@endif
