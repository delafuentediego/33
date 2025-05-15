// js/profile-inline-edit.js
document.addEventListener('DOMContentLoaded', () => {
  const container = document.querySelector('.profile-container');
  if (!container) return;

  container.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const input = btn.previousElementSibling;
      const field = input.name;
      const oldValue = input.value;
      input.readOnly = false; input.focus();

      const save = document.createElement('button');
      save.textContent = '✓'; save.className = 'save-btn';
      const cancel = document.createElement('button');
      cancel.textContent = '✕'; cancel.className = 'cancel-btn';
      btn.after(cancel); btn.after(save);

      save.addEventListener('click', () => {
        const newValue = input.value;
        fetch('php/ajax/update_profile.php', {
          method: 'POST',
          headers: {'Content-Type': 'application/json'},
          body: JSON.stringify({field, value: newValue})
        })
        .then(r => r.json())
        .then(res => {
          if (res.success) {
            input.readOnly = true;
            save.remove(); cancel.remove();
          } else {
            alert('Erreur de mise à jour');
            input.value = oldValue;
            input.readOnly = true;
            save.remove(); cancel.remove();
          }
        });
      });

      cancel.addEventListener('click', () => {
        input.value = oldValue;
        input.readOnly = true;
        save.remove(); cancel.remove();
      });
    });
  });
});
