<!-- layouts/pdf.blade.php -->
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Property Preview')</title>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            src: url('{{ storage_path('fonts/DejaVuSans.ttf') }}') format('truetype');
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #2d3748;
            background: white;
        }

        .container {
            width: 100%;
            padding: 0;
        }

        .cover-page {
            background: #f7fafc;
            text-align: center;
            padding: 100px 40px;
        }

        .logo-cover {
            max-height: 80px;
            margin-bottom: 40px;
        }

        .cover-welcome {
            font-size: 60px;
            font-weight: bold;
            color: #1a202c;
            margin-bottom: 10px;
        }

        .cover-subtitle {
            font-size: 24px;
            color: #4a5568;
            margin-bottom: 10px;
        }

        .cover-property-name {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .cover-address {
            font-size: 14px;
            color: #718096;
        }

        .page {
            padding: 40px;
            page-break-after: always;
        }

        .page-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .page-subtitle {
            font-size: 18px;
            color: #4a5568;
            line-height: 5px;
        }

        .info-grid > div {
            display: inline-block;
            width: 49%;
            vertical-align: top;
            margin-bottom: 20px;
        }

        .info-label {
            font-size: 16px;
            font-weight: bold;
        }

        .info-value {
            font-size: 16px;
            color: #4a5568;
        }

        .location-item{
            display: inline-block;
            width: 48%;
            vertical-align: top;
            margin-bottom: 20px;
            padding: 15px;
            background: #f7fafc;
            border-radius: 12px;
        }

        .rule-number{
            float: left;
        }

        .rule-item, .faq-item {
            margin-bottom: 15px;
            background: #f7fafc;
            padding: 20px 25px;
            margin-bottom: 15px;
            border-radius: 8px;
            border-left: 4px solid #4299e1;
        }

        .rule-content{
            display: block;
            margin-left: 30px;
        }

        .rule-title, .faq-question {
            font-weight: bold;
            font-size: 14px;
        }

        .rule-description, .faq-answer {
            font-size: 13px;
            color: #4a5568;
        }

        .gallery-grid img {
            width: 100px;
            height: auto;
            margin: 5px;
        }

        .contact-section {
            text-align: center;
            margin-top: 20px;
        }

        .gallery-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
