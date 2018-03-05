<script type="text/template" data-grid="inventory-variants" data-template="pagination">

    <% _.each(pagination, function(p) { %>

    <li data-grid="inventory" data-page="<%= p.page %>"><%= p.page_start %> - <%= p.page_limit %></li>

    <% }); %>

</script>
