export default {
    computed: {
        urlParams: function () {
            return new URLSearchParams(window.location.search)
        }
    },
    methods: {
        formatDate: function (dateString, onlyDate = false) {
            if (dateString === '' || dateString === null) {
                return null
            }
            const date = new Date(dateString);
            if (onlyDate) {
                const dateTimeFormat = new Intl.DateTimeFormat('en',
                    {
                        year: 'numeric',
                        month: 'short',
                        day: '2-digit',
                    });
                const [{value: month}, ,
                    {value: day}, ,
                    {value: year}, ,
                ] = dateTimeFormat.formatToParts(date);
                return `${day} ${month} ${year}`;
            } else {
                const dateTimeFormat = new Intl.DateTimeFormat('en',
                    {
                        year: 'numeric',
                        month: 'short',
                        day: '2-digit',
                        hour12: false,
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                const [{value: month}, ,
                    {value: day}, ,
                    {value: year}, ,
                    {value: hour}, ,
                    {value: minute}, ,
                ] = dateTimeFormat.formatToParts(date);
                return `${day} ${month} ${year} ${hour}:${minute}`;
            }
        },
        stripText(text) {
            if (text && text.length > 100) {
                return text.substring(0, 100) + '...'
            }
            return text
        },
    }
}
