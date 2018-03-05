<div class="input-group">
    {!! Form::text('category', (isset($category_name) ? $category_name : null), ['readonly', 'class'=>'form-control', 'placeholder'=>"Click 'Select'"]) !!}
    {!! Form::hidden('category_id', (isset($category_id) ? $category_id : null)) !!}
    <span class="input-group-btn">
    	<button class="btn btn-primary" data-toggle="modal" data-target="#workOrderCategoryModal" type="button">Select
        </button>
        <a href="{{ route('maintenance.work-orders.categories.index') }}" class="btn btn-default">Manage</a>
    </span>
</div><!-- /input-group -->

<!-- Modal -->
<div class="modal fade" id="workOrderCategoryModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Select a Work Order Category</h4>
            </div>
            <div class="modal-body">
                <div id="work-order-category-tree"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="work-order-category-select" type="button" class="btn btn-primary" disabled="disabled"
                        data-dismiss="modal">Select
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function (e) {
        var json_category_tree = null;

        $.get("{{ route('maintenance.api.v1.work-orders.categories.grid') }}", function (data) {
            json_category_tree = data;
        }).done(function () {
            if (json_category_tree != null) {
                $('#work-order-category-tree').on('changed.jstree', function (e, data) {

                    $('#work-order-category-select').attr('disabled', false);

                    for (i = 0, j = data.selected.length; i < j; i++) {
                        $('input[name="category_id"]').attr('value', data.instance.get_node(data.selected[i]).id);
                        $('input[name="category"]').attr('value', $.trim(data.instance.get_node(data.selected[i]).text));
                    }
                }).jstree({
                    "plugins": ["core", "json_data", "themes", "ui"],
                    'core': {
                        'data': json_category_tree,
                        'check_callback': true
                    }
                }).bind("loaded.jstree", function (event, data) {
                    $(this).jstree('select_node', $('input[name="category_id"]').val());
                    $(this).jstree("open_all");
                });
            }
        });
    });
</script>
