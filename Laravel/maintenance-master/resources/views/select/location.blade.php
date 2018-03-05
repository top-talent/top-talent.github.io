<div class="input-group">
    {!! Form::text('location', (isset($location_name) ? $location_name : null), ['readonly', 'class'=>'form-control', 'placeholder'=>"Click 'Select'"]) !!}
    {!! Form::hidden('location_id', (isset($location_id) ? $location_id : null)) !!}
    <span class="input-group-btn">
    	<button class="btn btn-primary" data-toggle="modal" data-target="#locationModal" type="button">Select</button>
        <a href="{{ route('maintenance.locations.index') }}" class="btn btn-default">Manage</a>
    </span>
</div><!-- /input-group -->

<!-- Modal -->
<div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Select a Location</h4>
            </div>
            <div class="modal-body">
                <div id="location-tree"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="location-select" type="button" class="btn btn-primary" disabled="disabled"
                        data-dismiss="modal">Select
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function (e) {
        var json_category_tree = null;

        $.get("{{ route('maintenance.api.v1.locations.grid') }}", function (data) {
            json_category_tree = data;
        }).done(function () {
            if (json_category_tree != null) {
                $('#location-tree').on('changed.jstree', function (e, data) {

                    $('#location-select').attr('disabled', false);

                    for (i = 0, j = data.selected.length; i < j; i++) {
                        $('input[name="location_id"]').attr('value', data.instance.get_node(data.selected[i]).id);
                        $('input[name="location"]').attr('value', $.trim(data.instance.get_node(data.selected[i]).text));
                    }
                }).jstree({
                    "plugins": ["core", "json_data", "themes", "ui"],
                    'core': {
                        'data': json_category_tree,
                        'check_callback': true
                    }
                }).bind("loaded.jstree", function (event, data) {
                    $('#location-tree').jstree('select_node', $('input[name="location_id"]').val());
                    $(this).jstree("open_all");
                });
            }
        });
    });
</script>
