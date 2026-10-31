<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Barcode - {{ $name }}</title>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            padding: 20px;
            background: #f5f5f5;
        }
        .print-container {
            max-width: 400px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .barcode-label {
            text-align: center;
            border: 2px dashed #ddd;
            padding: 25px;
            margin-bottom: 20px;
        }
        .item-type {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #999;
            margin-bottom: 10px;
        }
        .item-name {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }
        .item-price {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
        }
        .barcode-wrapper {
            padding: 15px;
            background: #fff;
            display: inline-block;
        }
        .barcode-number {
            font-family: 'Courier New', monospace;
            font-size: 14px;
            letter-spacing: 3px;
            color: #333;
            margin-top: 10px;
        }
        .print-btn {
            display: block;
            width: 100%;
            padding: 15px;
            background: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .print-btn:hover {
            background: #555;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #666;
            text-decoration: none;
        }
        .back-link:hover {
            color: #333;
        }

        /* Print Styles */
        @media print {
            body {
                background: #fff;
                padding: 0;
            }
            .print-container {
                box-shadow: none;
                max-width: 100%;
            }
            .print-btn, .back-link {
                display: none !important;
            }
            .barcode-label {
                border: 1px solid #000;
                page-break-inside: avoid;
            }
        }

        /* Multiple Labels for Printing */
        .labels-grid {
            display: none;
        }
        @media print {
            .single-label {
                display: none;
            }
            .labels-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }
            .labels-grid .barcode-label {
                padding: 15px;
                margin: 0;
            }
            .labels-grid .item-name {
                font-size: 14px;
            }
            .labels-grid .item-price {
                font-size: 12px;
                margin-bottom: 10px;
            }
            .labels-grid .barcode-number {
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="print-container">
        <!-- Single Label View -->
        <div class="single-label">
            <div class="barcode-label">
                <div class="item-type">{{ ucfirst($type) }}</div>
                <div class="item-name">{{ $name }}</div>
                <div class="item-price">{{ $price }}</div>
                <div class="barcode-wrapper">
                    <svg id="barcode-single"></svg>
                </div>
                <div class="barcode-number">{{ $barcode }}</div>
            </div>
        </div>

        <!-- Multiple Labels for Print (6 labels per page) -->
        <div class="labels-grid">
            @for($i = 0; $i < 6; $i++)
            <div class="barcode-label">
                <div class="item-type">{{ ucfirst($type) }}</div>
                <div class="item-name">{{ $name }}</div>
                <div class="item-price">{{ $price }}</div>
                <div class="barcode-wrapper">
                    <svg class="barcode-print" id="barcode-{{ $i }}"></svg>
                </div>
                <div class="barcode-number">{{ $barcode }}</div>
            </div>
            @endfor
        </div>

        <button class="print-btn" onclick="window.print()">
            <i class="fa fa-print"></i> Print Barcode Labels
        </button>
        
        <a href="javascript:history.back()" class="back-link">← Back to Item</a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Single barcode
            JsBarcode("#barcode-single", "{{ $barcode }}", {
                format: "CODE128",
                lineColor: "#000",
                width: 2,
                height: 60,
                displayValue: false
            });

            // Print barcodes
            for (var i = 0; i < 6; i++) {
                JsBarcode("#barcode-" + i, "{{ $barcode }}", {
                    format: "CODE128",
                    lineColor: "#000",
                    width: 1.5,
                    height: 40,
                    displayValue: false
                });
            }
        });
    </script>
</body>
</html>
