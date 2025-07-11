<!DOCTYPE html>
<html>
<head>
    <title>Expenditure Records</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<h2>International Tourist Expenditure</h2>
<?php
include 'db.php';

// Fetch international data
$result = $conn->query("SELECT * FROM international_expenditure WHERE component != 'Total Expenditure'");
$int_2010 = [];
$int_2011 = [];
$int_labels = [];

echo "<table border='1'><tr><th>Component</th><th>2010</th><th>2011</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['component']}</td><td>{$row['year_2010']}</td><td>{$row['year_2011']}</td></tr>";
    $int_labels[] = $row['component'];
    $int_2010[] = $row['year_2010'];
    $int_2011[] = $row['year_2011'];
}
echo "</table>";
?>

<h2>Domestic Tourist Expenditure</h2>
<?php
// Fetch domestic data
$result = $conn->query("SELECT * FROM domestic_expenditure WHERE component != 'Total Expenditure'");
$dom_2010 = [];
$dom_2011 = [];
$dom_labels = [];

echo "<table border='1'><tr><th>Component</th><th>2010</th><th>2011</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['component']}</td><td>{$row['year_2010']}</td><td>{$row['year_2011']}</td></tr>";
    $dom_labels[] = $row['component'];
    $dom_2010[] = $row['year_2010'];
    $dom_2011[] = $row['year_2011'];
}
echo "</table>";
?>

<h2>International Tourist Expenditure (Bar Chart)</h2>
<canvas id="intGraph" width="200" height="100"></canvas>

<h2>Domestic Tourist Expenditure 2011 (Pie Chart)</h2>
<canvas id="domGraph" width="150" height="100"></canvas>

<script>
    const intCtx = document.getElementById('intGraph').getContext('2d');
    new Chart(intCtx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($int_labels); ?>,
            datasets: [
                {
                    label: '2010',
                    data: <?php echo json_encode($int_2010); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)'
                },
                {
                    label: '2011',
                    data: <?php echo json_encode($int_2011); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.3)'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'International Tourist Expenditure'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const domCtx = document.getElementById('domGraph').getContext('2d');
    new Chart(domCtx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($dom_labels); ?>,
            datasets: [{
                label: '2011',
                data: <?php echo json_encode($dom_2011); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(255, 159, 64, 0.6)',
                    'rgba(255, 205, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(201, 203, 207, 0.6)'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Domestic Tourist Expenditure 2011'
                }
            }
        }
    });
</script>
</body>
</html>
