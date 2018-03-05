<script type="text/template" data-grid="assets-work-orders" data-template="results">

    <% _.each(results, function(r){ %>

    <tr>
        <td><%= r.id %></td>
        <td><a href="<%= r.view_url %>"> <%= r.subject %> </a></td>
        <td><%= r.created_at %></td>
        <td><%= r.created_by %></td>
        <td><%= r.priority %></td>
        <td><%= r.status %></td>
        <td>
            <form method="post" action="<%= r.detach_url %>">
                {{ csrf_field() }}

                <input class="btn btn-sm btn-primary" value="Detach" type="submit">
            </form>
        </td>
    </tr>

    <% }); %>

</script>
