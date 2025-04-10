// Funções para o modal de transações
function openTransactionModal() {
    const modal = document.getElementById('transactionModal');
    modal.classList.remove('hidden');

    // Obter os filtros atuais
    const type = document.getElementById('filterType')?.value;
    const category = document.getElementById('filterCategory')?.value;
    const date = document.getElementById('filterDate')?.value;

    // Adicionar os filtros como campos hidden no formulário
    const form = modal.querySelector('form');
    if (form) {
        // Remover campos hidden existentes
        const existingHiddenFields = form.querySelectorAll('input[type="hidden"][name^="filter_"]');
        existingHiddenFields.forEach(field => field.remove());

        // Adicionar novos campos hidden
        if (type) {
            const typeInput = document.createElement('input');
            typeInput.type = 'hidden';
            typeInput.name = 'type';
            typeInput.value = type;
            form.appendChild(typeInput);
        }

        if (category) {
            const categoryInput = document.createElement('input');
            categoryInput.type = 'hidden';
            categoryInput.name = 'category';
            categoryInput.value = category;
            form.appendChild(categoryInput);
        }

        if (date) {
            const dateInput = document.createElement('input');
            dateInput.type = 'hidden';
            dateInput.name = 'date';
            dateInput.value = date;
            form.appendChild(dateInput);
        }
    }
}

function closeTransactionModal() {
    document.getElementById('transactionModal').classList.add('hidden');
}

// Quando o usuário clica fora do modal, fecha o modal
window.onclick = function(event) {
    const modal = document.getElementById('transactionModal');
    if (event.target === modal) {
        closeTransactionModal();
    }
}

// Função para editar transação recorrente
function editRecurringTransaction(id) {
    // Implementar lógica de edição
    console.log('Editar transação recorrente:', id);
}

// Funções para o histórico de transações
function filterTransactions() {
    const type = document.getElementById('filterType').value;
    const category = document.getElementById('filterCategory').value;
    const date = document.getElementById('filterDate').value;

    // Construir a URL com os parâmetros de filtro
    let url = new URL(window.location.href);
    url.searchParams.set('type', type);
    url.searchParams.set('category', category);
    if (date) {
        url.searchParams.set('date', date);
    } else {
        url.searchParams.delete('date');
    }

    // Redirecionar para a URL com os filtros
    window.location.href = url.toString();
}

// Adicionar event listeners para os filtros
document.addEventListener('DOMContentLoaded', function() {
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    const filterType = document.getElementById('filterType');
    const filterCategory = document.getElementById('filterCategory');
    const filterDate = document.getElementById('filterDate');

    if (filterType) {
        filterType.addEventListener('change', filterTransactions);
    }
    if (filterCategory) {
        filterCategory.addEventListener('change', filterTransactions);
    }
    if (filterDate) {
        filterDate.addEventListener('change', filterTransactions);
    }

    // Inicializar gráfico
    const ctx = document.getElementById('expensesChart');
    if (ctx) {
        const expensesData = @json($expensesByCategory);

        // Cores para as categorias
        const backgroundColors = [
            'rgba(255, 99, 132, 0.7)',
            'rgba(54, 162, 235, 0.7)',
            'rgba(255, 206, 86, 0.7)',
            'rgba(75, 192, 192, 0.7)',
            'rgba(153, 102, 255, 0.7)',
            'rgba(255, 159, 64, 0.7)',
            'rgba(199, 199, 199, 0.7)',
            'rgba(83, 102, 255, 0.7)',
            'rgba(40, 159, 64, 0.7)',
            'rgba(210, 199, 199, 0.7)',
        ];

        const chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: expensesData.map(item => item.name),
                datasets: [{
                    data: expensesData.map(item => item.amount),
                    backgroundColor: backgroundColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            boxWidth: 12,
                            padding: 15
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: R$ ${value.toFixed(2)} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });

        // Atualizar gráfico ao mudar o período
        document.getElementById('period').addEventListener('change', function() {
            // Implementar lógica de atualização do gráfico
            // Você precisará fazer uma requisição AJAX para buscar os dados do novo período
        });
    }
});

// Função para editar transação
function editTransaction(id) {
    // Implementar edição
    console.log('Editar transação:', id);
}
