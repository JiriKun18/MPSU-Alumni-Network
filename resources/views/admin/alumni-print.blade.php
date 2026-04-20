<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Directory Print</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', 'Helvetica', sans-serif;
            background: white;
            padding: 15px;
            color: #000;
            line-height: 1.4;
        }

        .print-header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .print-header {
            position: relative;
        }

        .header-logo {
            position: absolute;
            top: -10px;
            right: 0;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: white;
            border: 2px solid #000;
            padding: 3px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header-logo img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: contain;
        }

        .print-header h1 {
            font-size: 24px;
            margin-bottom: 5px;
            color: #000;
            font-weight: 900;
            letter-spacing: 0.5px;
        }

        .print-header p {
            font-size: 12px;
            color: #000;
            margin: 2px 0;
            font-weight: 600;
        }

        .print-date {
            text-align: right;
            font-size: 10px;
            color: #64748b;
            margin-bottom: 10px;
        }

        .print-metadata {
            background: #f8fafc;
            padding: 10px;
            border-left: 3px solid #000;
            margin-bottom: 15px;
            font-size: 11px;
        }

        .print-metadata p {
            margin: 3px 0;
        }

        .print-metadata strong {
            color: #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 10px;
            color: #000;
        }

        th {
            background: #000;
            color: white;
            padding: 8px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #000;
        }

        td {
            padding: 6px 8px;
            border: 1px solid #000;
            color: #000;
        }

        tbody tr:nth-child(odd) {
            background-color: white;
        }

        tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .total-count {
            margin-top: 10px;
            padding: 8px;
            background: white;
            border-left: 3px solid #000;
            font-weight: bold;
            color: #000;
            font-size: 11px;
        }

        .print-footer {
            margin-top: 15px;
            padding-top: 10px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            font-size: 9px;
            color: #64748b;
        }

        .no-data {
            text-align: center;
            padding: 30px;
            color: #64748b;
            font-size: 12px;
        }

        @media print {
            body {
                padding: 0;
                background: white;
            }

            .print-header {
                margin-bottom: 10px;
            }

            table {
                margin-top: 5px;
            }

            th, td {
                padding: 5px 6px;
                font-size: 9px;
            }
        }
    </style>
</head>
<body>
    <div class="print-header">
        <div class="header-logo">
            <img src="/images/logo_mpsu.png" alt="MPSU Logo">
        </div>
        <h1>MPSU ALUMNI DIRECTORY</h1>
        <p>Mountain Province State University</p>
    </div>

    <div class="print-date">
        <strong style="color: #000; font-weight: 900; font-size: 12px;">Printed on: {{ now()->format('F d, Y \a\t g:i A') }}</strong>
    </div>

    <div class="print-metadata">
        @if($filters['course'])
            <p><strong>Course:</strong> {{ $filters['course'] }}</p>
        @endif
        @if($filters['batch'])
            <p><strong>Batch:</strong> {{ $filters['batch'] }}</p>
        @endif
        @if($filters['search'])
            <p><strong>Search:</strong> {{ $filters['search'] }}</p>
        @endif
        <p><strong>Total Records:</strong> {{ $alumni->count() }}</p>
    </div>

    @if($alumni->count() > 0)
        <table>
            <thead>
                <tr>
                    <th style="width: 4%;">#</th>
                    <th style="width: 15%;">Name</th>
                    <th style="width: 10%;">Email</th>
                    <th style="width: 8%;">Contact</th>
                    <th style="width: 20%;">Course & Batch</th>
                    <th style="width: 28%;">Address</th>
                    <th style="width: 15%;">Employment Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alumni as $alumnus)
                    <tr>
                        <td style="text-align: center; font-weight: bold;">{{ $loop->iteration }}</td>
                        <td><strong>{{ $alumnus['name'] }}</strong></td>
                        <td>{{ $alumnus['email'] }}</td>
                        <td>{{ $alumnus['phone'] }}</td>
                        <td>
                            {{ $alumnus['course'] }}<br>
                            <strong>Batch {{ $alumnus['batch_year'] }}</strong>
                        </td>
                        <td>{{ $alumnus['address'] }}</td>
                        <td>
                            {{ $alumnus['employment_status'] }}
                            @if(!empty($alumnus['employment_type']))
                                <br><span style="font-size: 0.85em; color: #555;">{{ $alumnus['employment_type'] }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-count">
            Total Alumni Printed: {{ $alumni->count() }}
        </div>
    @else
        <div class="no-data">
            <p>No alumni records found matching the selected filters.</p>
        </div>
    @endif

    <div class="print-footer">
        <p>&copy; {{ now()->year }} Mountain Province State University. All rights reserved.</p>
    </div>

    <script>
        // Trigger print dialog when page loads
        window.addEventListener('load', function() {
            setTimeout(function() {
                window.print();
            }, 300);
        });
    </script>
</body>
</html>
