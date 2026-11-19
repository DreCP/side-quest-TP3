{{ include('layouts/header.php', {title: 'Side Quest - Journal de bord', activePage: 'visitlog'}) }}

<h2>Journal de bord</h2>

<table class="visit-log">
    <thead>
        <tr>
            <th>Date and Time</th>
            <th>Username</th>
            <th>IP Address</th>
            <th>Page Visited</th>
        </tr>
    </thead>
    <tbody>
        {% for visit in visits %}
            <tr>
                <td>{{ visit.visit_date }}</td>
                <td>{{ visit.username }}</td>
                <td>{{ visit.ip_address }}</td>
                <td>{{ visit.page }}</td>
            </tr>
        {% else %}
            <tr>
                <td colspan="4">No visits recorded yet.</td>
            </tr>
        {% endfor %}
    </tbody>
</table>

{{ include('layouts/footer.php') }}
