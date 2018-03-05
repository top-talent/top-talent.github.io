<script type="text/template" data-grid="inventory-variants" data-template="results">

    <% _.each(results, function(r){ %>

    <tr>
        <td><%= r.id %></td>
        <td><%= r.sku %></td>
        <td><a href="<%= r.view_url %>"><%= r.name %></a></td>
        <td><%= r.category %></td>
        <td><%= r.current_stock %></td>
        <td><%= r.created_at %></td>
        <td><a class="btn btn-sm btn-primary" href="<%= r.select_url %>">Select</a></td>
    </tr>

    <% }); %>

</script>
