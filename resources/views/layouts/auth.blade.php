<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - StyleHub Wardrobe Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#9F7AEA',
                        secondary: '#4FD1C5',
                        accent: '#FC8181',
                        light: '#F7FAFC',
                        dark: '#2D3748',
                        success: '#68D391'
                    },
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        input {
            outline: none;
        }
        .glass-container {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }
        .form-input {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            transition: all 0.3s ease;
        }
        .form-input:focus {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.4);
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
        }
        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        .social-btn {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }
        .social-btn:hover {
            background: rgba(255, 255, 255, 0.25);
        }
        .submit-btn {
            width: 100%;
            /* padding: 16px; */
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 12px;
            color: #764ba2;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .submit-btn:hover {
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }
        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.7);
            cursor: pointer;
        }
    </style>
    @stack('styles')
</head>
<body class="font-inter min-h-screen flex items-center justify-center p-4">
    <div class="glass-container rounded-3xl overflow-hidden w-full max-w-md">
        <!-- Header -->
        <div class="bg-white bg-opacity-20 py-8 px-8 text-center border-b border-white border-opacity-20">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white bg-opacity-30 mb-4">
                <i class="fas fa-tshirt text-white text-2xl"></i>
            </div>
            @yield('header')
        </div>
        
        <!-- Form -->
        <div class="p-8">
            @yield('content')
        </div>
    </div>

    @stack('scripts')
</body>
</html>
