<script type="text/template" data-grid="assets-meters-readings" data-template="results">

    <% _.each(results, function(r){ %>

    <tr>
        <td><%= r.reading %></td>
        <td><%= r.comment %></td>
        <td><%= r.user %></td>
        <td><%= r.created_at %></td>
    </tr>

    <% }); %>

</script>
