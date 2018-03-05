<script type="text/template" data-grid="main" data-template="results">

    <% _.each(results, function(r){ %>

    <tr>
        <td><a href="<%= r.view_url %>"> <%= r.title %> </a></td>
        <td><%= r.location %></td>
        <td><%= r.start %></td>
        <td><%= r.end %></td>
    </tr>

    <% }); %>

</script>
