// js/personalization.js
document.addEventListener('DOMContentLoaded', () => {
  const stepSelects = document.querySelectorAll('.step-select');
  const totalEl = document.getElementById('total');
  const voyageId = document.querySelector('input[name="voyage_id"]').value;

  // 1) charger dynamiquement chaque liste d'options
  stepSelects.forEach(sel => {
    const stepId = sel.dataset.stepId;
    fetch(`php/ajax/get_options.php?stepId=${stepId}`)
      .then(r => r.json())
      .then(options => {
        sel.innerHTML = options.map(o =>
          `<option value="${o.value}" data-price="${o.price}">${o.label} (+${o.price}€)</option>`
        ).join('');
      });
  });

  // 2) calculer prix asynchrone
  function recalc() {
    const opts = {};
    stepSelects.forEach(sel => {
      opts[sel.name] = sel.value;
    });
    fetch('php/ajax/calc_price.php', {
      method:'POST',
      headers:{'Content-Type':'application/json'},
      body: JSON.stringify({voyageId, options: opts})
    })
    .then(r => r.json())
    .then(res => totalEl.textContent = res.total.toFixed(2) + ' €');
  }

  stepSelects.forEach(sel => sel.addEventListener('change', recalc));
  recalc();
});
