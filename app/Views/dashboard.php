<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?= base_url('css/dashboard.css') ?>">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h2>Bem-vindo, <?= esc($usuario['nome']) ?>!</h2>

    <nav>
        <a href="<?= site_url('categorias') ?>">Categorias</a>
        <a href="<?= site_url('transacoes') ?>">Transações</a>
        <a href="<?= site_url('logout') ?>">Sair</a>
    </nav>

    <div class="dashboard-stats">
        <div class="stat-card">
            <h3>Total de Transações</h3>
            <p class="stat-number"><?= $totalTransacoes ?></p>
        </div>
        <div class="stat-card receitas">
            <h3>Total Receitas</h3>
            <p class="stat-number">R$ <?= number_format($totalReceitas, 2, ',', '.') ?></p>
        </div>
        <div class="stat-card despesas">
            <h3>Total Despesas</h3>
            <p class="stat-number">R$ <?= number_format($totalDespesas, 2, ',', '.') ?></p>
        </div>
        <div class="stat-card saldo">
            <h3>Saldo</h3>
            <p class="stat-number">R$ <?= number_format($totalReceitas - $totalDespesas, 2, ',', '.') ?></p>
        </div>
    </div>

    <div class="charts-container">
        <div class="chart-card">
            <h3>Receitas vs Despesas</h3>
            <canvas id="receitasDespesasChart"></canvas>
        </div>
        
        <div class="chart-card">
            <h3>Top 5 Categorias</h3>
            <canvas id="topCategoriasChart"></canvas>
        </div>
    </div>

    <script>
        const ctx1 = document.getElementById('receitasDespesasChart').getContext('2d');
        const receitasDespesasChart = new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: ['Receitas', 'Despesas'],
                datasets: [{
                    data: [<?= $totalReceitas ?>, <?= $totalDespesas ?>],
                    backgroundColor: ['#4CAF50', '#f44336'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            color: '#f0f0f0'
                        }
                    }
                }
            }
        });

        const ctx2 = document.getElementById('topCategoriasChart').getContext('2d');
        const topCategoriasChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: [<?php foreach($topCategorias as $categoria => $valor): ?>'<?= esc($categoria) ?>',<?php endforeach; ?>],
                datasets: [{
                    label: 'Valor (R$)',
                    data: [<?php foreach($topCategorias as $categoria => $valor): ?><?= $valor ?>,<?php endforeach; ?>],
                    backgroundColor: '#4CAF50',
                    borderColor: '#45a049',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#f0f0f0'
                        },
                        grid: {
                            color: '#333'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#f0f0f0'
                        },
                        grid: {
                            color: '#333'
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#f0f0f0'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
