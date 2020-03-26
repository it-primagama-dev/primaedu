
{{ content() }}

<h1>
    {{ link_to("tentor/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
        I-Smart
    </h1>

    <table class="table bordered striped hovered">
        <thead>
            <tr>
                <th>Kode I-Smart</th>
                <th>Nama I-Smart</th>
                <th>Grade</th>
                <th>Tipe I-Smart</th>
                <th>Telepon</th>
                <th>Email</th>
                <th>Cabang</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
    {% if page.items is defined %}
    {% for ismart in page.items %}
                <tr>
                    <td>{{ ismart.KodeISmart }}</td>
                    <td>{{ ismart.NamaISmart }}</td>
                    <td>{{ ismart.Grade }}</td>
                    <td>{{ ismart.TipeISmart }}</td>
                    <td>{{ ismart.Telepon }}</td>
                    <td>{{ ismart.Email }}</td>
                    <td>{{ ismart.getNamaCabang() }}</td>
                    <td>{{ link_to("tentor/edit/"~ismart.RecID, "Edit") }}</td>
                    <td>{{ link_to("tentor/delete/"~ismart.RecID, "Delete") }}</td>
                </tr>
    {% endfor %}
    {% endif %}
            </tbody>
        </table>
        <div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
        <div class="place-right">
    {{ link_to("tentor/search", "First", 'class':'button') }}
    {{ link_to("tentor/search?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("tentor/search?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("tentor/search?page="~page.last, "Last", 'class':'button') }}
            </div>