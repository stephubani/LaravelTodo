
document.addEventListener('DOMContentLoaded', () => {
    const todoColumn = document.getElementById('todo-column');

    Sortable.create(todoColumn, {
        animation: 150,
        onEnd: function () {
            let order = [];
            document.querySelectorAll('#todo-column > div[data-id]').forEach(item => {
                order.push(item.getAttribute('data-id'));
            });

            fetch('/todo/reorder', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({ tasks: order })
            })
            .then(response => response.json())
            .then(data => console.log('Updated order:', data));
        }
    });
});

