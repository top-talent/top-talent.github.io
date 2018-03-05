<script type="text/template" data-grid="assets-images" data-template="results">

    <% _.each(results, function(r){ %>

    <tr>
        <td><%= r.icon %></td>
        <td><a href="<%= r.view_url %>"><%= r.name %></a></td>
        <td><%= r.file_name %></td>
        <td><%= r.user %></td>
        <td><%= r.created_at %></td>
    </tr>

    <% }); %>

</script>
