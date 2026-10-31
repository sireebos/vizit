<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code - {{ $settings->site_name ?? config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #b59f6a;
            --dark-bg: #1a1a2e;
            --card-bg: #16213e;
            --text-light: #eee;
            --text-muted: #aaa;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--dark-bg) 0%, #0f0f23 100%);
            min-height: 100vh;
            color: var(--text-light);
            display: flex;
            flex-direction: column;
        }
        
        .header-section {
            background: linear-gradient(135deg, var(--card-bg) 0%, var(--dark-bg) 100%);
            padding: 20px;
            text-align: center;
            border-bottom: 3px solid var(--primary-color);
        }
        
        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }
        
        .qr-container {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0,0,0,0.4);
        }
        
        .qr-title {
            color: var(--primary-color);
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .qr-subtitle {
            color: var(--text-muted);
            margin-bottom: 30px;
        }
        
        .qr-code-wrapper {
            background: white;
            padding: 20px;
            border-radius: 15px;
            display: inline-block;
            margin-bottom: 30px;
        }
        
        #qrcode {
            display: flex;
            justify-content: center;
        }
        
        .qr-url {
            background: rgba(0,0,0,0.3);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            word-break: break-all;
        }
        
        .qr-url a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .btn-actions {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn-action {
            padding: 12px 25px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-primary-custom {
            background: var(--primary-color);
            color: #000;
        }
        
        .btn-primary-custom:hover {
            background: #a08c5a;
            color: #000;
            transform: translateY(-2px);
        }
        
        .btn-secondary-custom {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
        }
        
        .btn-secondary-custom:hover {
            background: var(--primary-color);
            color: #000;
        }
        
        .footer-section {
            background: var(--card-bg);
            padding: 15px;
            text-align: center;
            border-top: 2px solid var(--primary-color);
        }
        
        .footer-section p {
            color: var(--text-muted);
            margin: 0;
            font-size: 0.9rem;
        }
        
        .footer-section a {
            color: var(--primary-color);
        }
        
        @media print {
            body {
                background: white !important;
            }
            
            .header-section, .footer-section, .btn-actions {
                display: none !important;
            }
            
            .main-content {
                padding: 0;
            }
            
            .qr-container {
                box-shadow: none;
                background: white;
                color: #333;
            }
            
            .qr-title {
                color: #333;
            }
            
            .qr-subtitle, .qr-url {
                color: #666;
                background: #f5f5f5;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header-section">
        <a href="{{ route('catalog.index') }}" style="text-decoration: none;">
            <span class="logo-text"><i class="fas fa-arrow-left me-2"></i>{{ $settings->site_name ?? 'Vizit Hotel & Suites' }}</span>
        </a>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <div class="qr-container">
            <h1 class="qr-title"><i class="fas fa-qrcode me-2"></i>Scan to View Menu</h1>
            <p class="qr-subtitle">Point your phone camera at the QR code to access our digital menu</p>
            
            <div class="qr-code-wrapper">
                <div id="qrcode"></div>
            </div>
            
            <div class="qr-url">
                <i class="fas fa-link me-2"></i>
                <a href="{{ $catalogUrl }}" target="_blank">{{ $catalogUrl }}</a>
            </div>
            
            <div class="btn-actions">
                <button onclick="window.print()" class="btn-action btn-primary-custom">
                    <i class="fas fa-print"></i> Print QR Code
                </button>
                <button onclick="downloadQR()" class="btn-action btn-secondary-custom">
                    <i class="fas fa-download"></i> Download
                </button>
                <a href="{{ route('catalog.index') }}" class="btn-action btn-secondary-custom">
                    <i class="fas fa-arrow-left"></i> Back to Menu
                </a>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <div class="footer-section">
        <p>&copy; {{ date('Y') }} {{ $settings->site_name ?? 'Vizit Hotel & Suites' }} · <a href="{{ url('/') }}">{{ request()->getHost() }}</a></p>
    </div>
    
    <!-- QRCode.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
    <script>
        // Generate QR Code
        const qrcode = new QRCode(document.getElementById("qrcode"), {
            text: "{{ $catalogUrl }}",
            width: 250,
            height: 250,
            colorDark: "#1a1a2e",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
        
        // Download QR Code
        function downloadQR() {
            const canvas = document.querySelector('#qrcode canvas');
            if (canvas) {
                const link = document.createElement('a');
                link.download = 'menu-qrcode.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
            }
        }
    </script>
</body>
</html>
