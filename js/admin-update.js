// js/admin-update.js
document.addEventListener('DOMContentLoaded', () => {
  const tbody = document.getElementById('user-table-body');
  if (!tbody) return;

  tbody.addEventListener('click', e => {
    if (e.target.tagName !== 'BUTTON') return;
    const btn = e.target;
    const tr = btn.closest('tr');
    const id = btn.dataset.id;
    const field = btn.dataset.field; // ex: 'active'
    const input = tr.querySelector(`[name="${field}"]`);
    const value = input.type==='checkbox' ? input.checked : input.value;

    btn.disabled = true;
    const spinner = document.createElement('span');
    spinner.className = 'spinner'; // vous pouvez styliser .spinner en CSS
    btn.after(spinner);

    fetch('php/ajax/update_user_admin.php', {
      method: 'POST',
      headers: {'Content-Type':'application/json'},
      body: JSON.stringify({id, field, value})
    })
    .then(r => r.json())
    .then(res => {
      spinner.remove(); btn.disabled = false;
      if (!res.success) alert('Échec mise à jour');
    });
  });
});
