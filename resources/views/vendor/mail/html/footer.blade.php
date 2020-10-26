<tr>
    <td class="footer" width="100%" cellpadding="0" cellspacing="0" align="center">
        <table class="inner-body" width="600" cellpadding="0" cellspacing="0" role="presentation">
            <tr>
                <td class="content-cell">
                    {{ Illuminate\Mail\Markdown::parse($slot) }}
                </td>
            </tr>
        </table>
    </td>
</tr>