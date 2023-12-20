<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    @vite('resources/css/app.css')
    <!-- Styles -->

</head>
<body>
<div class="w-full max-w-xs">
    <form id="yourForm"
          class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                Title
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="title" type="text" placeholder="Username" name="title"
            >
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="coin">
                Coin
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="coin" type="number" placeholder="Coin" name="coin"
            >
        </div>

        <div class="flex items-center justify-between">
            <button
                id="submitBtn"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit">
                Submit
            </button>
        </div>
    </form>
    <p class="text-center text-gray-500 text-xs">
        &copy;2020 Acme Corp. All rights reserved.
    </p>
</div>


<!-- Include SweetAlert2 from CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        $("#submitBtn").click(function () {
            // Disable the button to prevent multiple clicks
            $(this).prop("disabled", true);

            // Get form data
            var formData = {
                title: $("#title").val(),
                coin: $("#coin").val(),
                _token: $("input[name=_token]").val()
            };

            // Submit form data via AJAX
            $.ajax({
                type: "POST",
                url: "{{ route('post.store') }}",
                data: formData,
                success: function (response) {
                    // Handle successful response with SweetAlert2
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                    });

                    // Re-enable the button
                    $("#submitBtn").prop("disabled", false);
                },
                error: function (error) {
                    // Handle error response with SweetAlert2
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while processing your request.',
                    });

                    // Re-enable the button
                    $("#submitBtn").prop("disabled", false);
                }
            });
        });
    });
</script>
</body>
</html>

