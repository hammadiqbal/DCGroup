<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Contact Us - DC Group</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            background-color: #FDFDFC;
            color: #1b1b18;
            min-height: 100vh;
            line-height: 1.6;
        }
        .container {
            max-width: 42rem;
            margin: 0 auto;
            padding: 1rem 2rem;
        }
        .bg-white {
            background-color: white;
        }
        .shadow-lg {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        .rounded-lg {
            border-radius: 0.5rem;
        }
        .p-6 {
            padding: 1.5rem;
        }
        .mb-2 {
            margin-bottom: 0.5rem;
        }
        .mb-6 {
            margin-bottom: 1.5rem;
        }
        .text-3xl {
            font-size: 1.875rem;
        }
        .font-bold {
            font-weight: 700;
        }
        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        .py-3 {
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }
        .py-8 {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }
        .rounded {
            border-radius: 0.25rem;
        }
        .border {
            border-width: 1px;
            border-style: solid;
        }
        input, textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #e3e3e0;
            border-radius: 0.5rem;
            font-size: 1rem;
            background-color: white;
            color: #1b1b18;
            font-family: inherit;
        }
        input:focus, textarea:focus {
            outline: none;
            border-color: #1b1b18;
            box-shadow: 0 0 0 2px rgba(27, 27, 24, 0.1);
        }
        textarea {
            resize: vertical;
            min-height: 120px;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #1b1b18;
            font-size: 0.875rem;
        }
        button {
            width: 100%;
            background-color: #1b1b18;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            font-weight: 500;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        button:hover {
            background-color: #000;
        }
        .bg-green-50 {
            background-color: #f0fdf4;
        }
        .border-green-200 {
            border-color: #bbf7d0;
        }
        .text-green-800 {
            color: #166534;
        }
        .bg-red-50 {
            background-color: #fef2f2;
        }
        .border-red-200 {
            border-color: #fecaca;
        }
        .text-red-800 {
            color: #991b1b;
        }
        .text-red-500 {
            color: #ef4444;
        }
        .text-sm {
            font-size: 0.875rem;
        }
        .mt-1 {
            margin-top: 0.25rem;
        }
        .border-red-500 {
            border-color: #ef4444 !important;
        }
        button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h1 class="text-3xl font-bold mb-2">Contact Us</h1>
            <p style="color: #706f6c; margin-bottom: 1.5rem;">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <div id="alert-message" style="display: none;"></div>

            <form id="contact-form" action="{{ route('contact.store') }}" method="POST">
                @csrf
                
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">
                        Name <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}" 
                        required 
                        maxlength="100"
                        class="w-full px-4 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg bg-white dark:bg-[#161615] text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#1b1b18] dark:focus:ring-[#EDEDEC] focus:border-transparent"
                    >
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required
                        class="w-full px-4 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg bg-white dark:bg-[#161615] text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#1b1b18] dark:focus:ring-[#EDEDEC] focus:border-transparent"
                    >
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="subject" class="block text-sm font-medium mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">
                        Subject <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="subject" 
                        name="subject" 
                        value="{{ old('subject') }}" 
                        required 
                        maxlength="150"
                        class="w-full px-4 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg bg-white dark:bg-[#161615] text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#1b1b18] dark:focus:ring-[#EDEDEC] focus:border-transparent"
                    >
                    @error('subject')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="message" class="block text-sm font-medium mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">
                        Message <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="message" 
                        name="message" 
                        rows="6" 
                        required 
                        maxlength="2000"
                        class="w-full px-4 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg bg-white dark:bg-[#161615] text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#1b1b18] dark:focus:ring-[#EDEDEC] focus:border-transparent resize-y"
                    >{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button 
                    type="submit" 
                    id="submit-btn"
                    class="w-full bg-[#1b1b18] dark:bg-[#EDEDEC] text-white dark:text-[#1b1b18] py-3 px-6 rounded-lg font-medium hover:bg-black dark:hover:bg-white transition-colors duration-200"
                >
                    <span id="submit-text">Send Message</span>
                    <span id="submit-loading" style="display: none;">Sending...</span>
                </button>
            </form>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#contact-form').on('submit', function(e) {
                e.preventDefault();
                
                $('#alert-message').hide().removeClass('bg-green-50 bg-red-50 text-green-800 text-red-800');
                $('.error-field').remove();
                $('input, textarea').removeClass('border-red-500');
                
                $('#submit-btn').prop('disabled', true);
                $('#submit-text').hide();
                $('#submit-loading').show();
                
                // Get form data
                var formData = {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    subject: $('#subject').val(),
                    message: $('#message').val(),
                    _token: $('input[name="_token"]').val()
                };
                
                // AJAX request
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    dataType: 'json',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        // Show success message
                        showAlert(response.message, 'success');
                        
                        // Reset form
                        $('#contact-form')[0].reset();
                        
                        // Enable submit button
                        $('#submit-btn').prop('disabled', false);
                        $('#submit-text').show();
                        $('#submit-loading').hide();
                    },
                    error: function(xhr) {
                        // Enable submit button
                        $('#submit-btn').prop('disabled', false);
                        $('#submit-text').show();
                        $('#submit-loading').hide();
                        
                        if (xhr.status === 422) {
                            // Validation errors
                            var errors = xhr.responseJSON.errors;
                            
                            $.each(errors, function(field, messages) {
                                var input = $('#' + field);
                                input.addClass('border-red-500');
                                
                                // Add error message below input
                                var errorHtml = '<p class="error-field text-red-500 text-sm mt-1">' + messages[0] + '</p>';
                                input.after(errorHtml);
                            });
                            
                            showAlert('Please correct the errors in the form.', 'error');
                        } else {
                            // Other errors
                            var errorMessage = xhr.responseJSON?.message || 'Sorry, there was an error sending your message. Please try again later.';
                            showAlert(errorMessage, 'error');
                        }
                    }
                });
            });
            
            function showAlert(message, type) {
                var alertClass = type === 'success' ? 'bg-green-50 border border-green-200 text-green-800' : 'bg-red-50 border border-red-200 text-red-800';
                $('#alert-message')
                    .removeClass('bg-green-50 bg-red-50 border border-green-200 border-red-200 text-green-800 text-red-800')
                    .addClass(alertClass + ' px-4 py-3 rounded mb-6')
                    .text(message)
                    .show();
                
                // Scroll to top to show message
                $('html, body').animate({
                    scrollTop: 0
                }, 300);
            }
        });
    </script>

</body>
</html>

