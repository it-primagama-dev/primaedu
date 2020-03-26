
{{ content() }}

<table width="100%">
    <tr>
        <td align="left">
            {{ link_to("testsql/index", "Go Back") }}
        </td>
        <td align="right">
            {{ link_to("testsql/new", "Create ") }}
        </td>
    </tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nama</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for testsql in page.items %}
        <tr>
            <td>{{ testsql.id }}</td>
            <td>{{ testsql.nama }}</td>
            <td>{{ link_to("testsql/edit/"~testsql.id, "Edit") }}</td>
            <td>{{ link_to("testsql/delete/"~testsql.id, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td>{{ link_to("testsql/search", "First") }}</td>
                        <td>{{ link_to("testsql/search?page="~page.before, "Previous") }}</td>
                        <td>{{ link_to("testsql/search?page="~page.next, "Next") }}</td>
                        <td>{{ link_to("testsql/search?page="~page.last, "Last") }}</td>
                        <td>{{ page.current~"/"~page.total_pages }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
