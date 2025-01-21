// $(document).ready(function() {
//     console.log($.fn.jquery);
//     $('#users-table').DataTable({
//         processing: true,
//         serverSide: true,
//         ajax: {
//             url: '{{ route("admin.users") }}', // Adjust this URL to your route
//             type: 'GET'
//         },
//         columns: [
//             { data: 'id', name: 'id' },
//             { data: 'name', name: 'name' },
//             { data: 'email', name: 'email' },
//             { data: 'created_at', name: 'created_at' },
//             { data: 'actions', name: 'actions', orderable: false, searchable: false }
//         ]
//     });
// });