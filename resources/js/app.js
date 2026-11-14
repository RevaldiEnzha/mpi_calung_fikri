import '@hotwired/turbo';

function initCategoryFilters() {
    document.querySelectorAll('[data-filter-items]').forEach((bar) => {
        const buttons = bar.querySelectorAll('.filter-btn');
        const items = document.querySelectorAll(bar.dataset.filterItems);
        const empty = bar.dataset.filterEmpty ? document.querySelector(bar.dataset.filterEmpty) : null;
        if (!buttons.length || !items.length) return;

        const setActive = (active) => buttons.forEach((b) => {
            const on = b === active;
            b.classList.toggle('is-active', on);
            b.setAttribute('aria-pressed', on ? 'true' : 'false');
        });
        setActive(bar.querySelector('.filter-btn.is-active') || buttons[0]);

        buttons.forEach((btn) => btn.addEventListener('click', () => {
            setActive(btn);

            const cat = btn.dataset.category;
            let shown = 0;
            items.forEach((item) => {
                const match = cat === 'Semua' || item.dataset.category === cat;
                item.style.display = match ? '' : 'none';
                if (match) { item.classList.add('is-revealed'); shown++; }
            });
            if (empty) empty.classList.toggle('hidden', shown > 0);
        }));
    });
}

document.addEventListener('turbo:load', initCategoryFilters);
document.addEventListener('DOMContentLoaded', () => { if (!window.Turbo) initCategoryFilters(); });
