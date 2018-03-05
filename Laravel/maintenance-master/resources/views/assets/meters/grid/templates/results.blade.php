<script type="text/template" data-grid="assets-meters" data-template="results">

    <% _.each(results, function(r){ %>

    <tr>
        <td><a href="<%= r.view_url %>"><%= r.name %></a></td>
        <td><%= r.metric %></td>
        <td><%= r.reading %></td>
        <td><%= r.comment %></td>
        <td><%= r.user %></td>
        <td><%= r.created_at %></td>
    </tr>

    <% }); %>

</script>
