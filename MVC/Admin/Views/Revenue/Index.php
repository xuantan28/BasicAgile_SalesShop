<div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <input type="number" id="year" class="form-control" min="2000" max="<?php echo date('Y'); ?>" value="<?php echo $model['year']; ?>"/>
                </div>
            </div>
            <div class="col-md-2">
                <button onclick="changeYear('<?php echo ADMIN_BASE_URL; ?>Revenue/Index/');" class="btn btn-primary">View</button>
            </div>
            <div class="col-md-8 d-flex flex-column justify-content-center align-items-end">
                <label class="font-weight-bold">Revenue of <?php echo $model['year'].': '.number_format($model['sumRevenue'],0,'',',').' / '.number_format($model['minimumRevenue'],0,'',',').' ( '.floor(($model['sumRevenue']*100)/$model['minimumRevenue']).'% / 100% )'; ?></label>
                <?php $amount = floor(($model['sumRevenue']*100)/$model['minimumRevenue'])-floor(($model['sumRevenuePre']*100)/$model['minimumRevenue']); ?>
                <?php if($amount>0): ?>
                    <label class="font-weight-bold"><i class="fas fa-level-up-alt text-success"></i> <?php echo $amount; ?>% increase compared to the previous year </label>
                <?php elseif ($amount<0): ?>
                    <label class="font-weight-bold"><i class="fas fa-level-down-alt text-danger"></i> <?php echo $amount; ?>% decrease compared to the previous year </label>
                <?php else: ?>
                    <label class="font-weight-bold"> No changes compared to the previous year </label>
                <?php endif; ?>
            </div>
        </div>
        <canvas id="myChart"></canvas>
    </div>



<script>
    //chart js
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: ' Revenue',
                data: [<?php
                    for ($i=0; $i < 12; $i++) { 
                        echo $model['arrayRevenue'][$i];
                        if ($i<11){
                            echo ',';
                        }
                    }
                ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            title: {
                display:true,
                text: '2021 Revenue Observation Chart'
            }
        }
    });
</script>