@if($item->notes->count() > 0)
    {!!
        $item->notes->columns([
            'content' => 'Note',
            'created_by' => 'Created By',
            'action' => 'Action'
        ])
        ->means('created_by', 'user.full_name')
        ->modify('action', function($note) use($item)
        {
            return $item->viewer()->btnNoteActions($note);
        })
        ->render()
    !!}
@else
    <h5>There are no notes to display.</h5>
@endif
