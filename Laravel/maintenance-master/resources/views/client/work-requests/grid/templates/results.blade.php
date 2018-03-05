<script type="text/template" data-grid="work-requests" data-template="results">

    <% _.each(results, function(r){ %>

    <tr>
        <td><a href="<%= r.view_url %>"> <%= r.subject %> </a></td>
        <td><%= r.description %></td>
        <td><%= r.best_time %></td>
        <td><%= r.status %></td>
        <td><%= r.created_at %></td>
    </tr>

    <% }); %>

</script>
