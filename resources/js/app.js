// Reproductor SIMULADO (sin audio): un temporizador avanza el progreso.
// El estado vive en sessionStorage para que siga igual al navegar entre pantallas.

const pistas = window.pistas ?? [];
const $$ = (sel) => [...document.querySelectorAll(sel)];
const fmt = (s) => `${String(Math.floor(s / 60)).padStart(2, '0')}:${String(s % 60).padStart(2, '0')}`;

const CLAVE = 'sonora-estado';
let estado = { i: 0, t: 0, sonando: false, aleatorio: false, volumen: 70 };
let temporizador = null;

/* ---------- Estado ---------- */
function cargar() {
    try {
        const guardado = JSON.parse(sessionStorage.getItem(CLAVE));
        if (guardado) {
            estado = { ...estado, ...guardado };
            // Si sonaba al salir de la página, suma el tiempo que pasó.
            if (estado.sonando && guardado.ts) estado.t += Math.floor((Date.now() - guardado.ts) / 1000);
        }
    } catch (_) {}
    if (!pistas[estado.i]) estado.i = 0;
    estado.t = Math.min(estado.t, pistas[estado.i].dur - 1);
}

function guardar() {
    try { sessionStorage.setItem(CLAVE, JSON.stringify({ ...estado, ts: Date.now() })); } catch (_) {}
}

/* ---------- Pintar la interfaz ---------- */
function pintar() {
    const p = pistas[estado.i];
    if (!p) return;
    const pct = (estado.t / p.dur) * 100;

    $$('[data-ui="titulo"]').forEach((e) => (e.textContent = p.titulo));
    $$('[data-ui="artista"]').forEach((e) => (e.textContent = p.artista));
    $$('[data-ui="tiempo"]').forEach((e) => (e.textContent = fmt(estado.t)));
    $$('[data-ui="duracion"]').forEach((e) => (e.textContent = fmt(p.dur)));
    $$('[data-ui="relleno"]').forEach((e) => (e.style.width = `${pct}%`));
    $$('[data-ui="barra"]').forEach((b) => {
        b.setAttribute('aria-valuenow', Math.round(pct));
        b.setAttribute('aria-valuetext', `${fmt(estado.t)} de ${fmt(p.dur)}`);
    });
    $$('[data-pista]').forEach((fila) => {
        if (Number(fila.dataset.pista) === estado.i) fila.setAttribute('aria-current', 'true');
        else fila.removeAttribute('aria-current');
    });
}

function pintarBotones() {
    $$('[data-accion="alternar"]').forEach((b) => {
        b.setAttribute('aria-label', estado.sonando ? 'Pausar' : 'Reproducir');
        b.querySelector('[data-icono="play"]')?.classList.toggle('hidden', estado.sonando);
        b.querySelector('[data-icono="pause"]')?.classList.toggle('hidden', !estado.sonando);
    });
    $$('[data-accion="aleatorio"]').forEach((b) => b.setAttribute('aria-pressed', String(estado.aleatorio)));
    $$('[data-ui="volumen"]').forEach((r) => (r.value = estado.volumen));
}

/* ---------- Acciones ---------- */
function reproducir() {
    clearInterval(temporizador);
    estado.sonando = true;
    temporizador = setInterval(() => {
        estado.t++;
        if (estado.t >= pistas[estado.i].dur) { siguiente(); return; }
        pintar();
        guardar();
    }, 1000);
    pintarBotones();
    guardar();
}

function pausar() {
    clearInterval(temporizador);
    temporizador = null;
    estado.sonando = false;
    pintarBotones();
    guardar();
}

function irA(indice) {
    estado.i = (indice + pistas.length) % pistas.length;
    estado.t = 0;
    pintar();
    guardar();
}

function siguiente() {
    if (estado.aleatorio && pistas.length > 1) {
        let n;
        do { n = Math.floor(Math.random() * pistas.length); } while (n === estado.i);
        irA(n);
    } else {
        irA(estado.i + 1);
    }
}

function anterior() {
    // Como en cualquier reproductor: si ya avanzó más de 3 s, reinicia la canción.
    if (estado.t > 3) irA(estado.i); else irA(estado.i - 1);
}

function buscar(segundos) {
    estado.t = Math.max(0, Math.min(Math.round(segundos), pistas[estado.i].dur - 1));
    pintar();
    guardar();
}

/* ---------- Eventos ---------- */
document.addEventListener('click', (e) => {
    // Reproducir una pista concreta (filas y botones con data-reproducir)
    const destino = e.target.closest('[data-reproducir]');
    if (destino) { irA(Number(destino.dataset.reproducir)); reproducir(); return; }

    const boton = e.target.closest('[data-accion]');
    switch (boton?.dataset.accion) {
        case 'alternar': estado.sonando ? pausar() : reproducir(); break;
        case 'siguiente': siguiente(); break;
        case 'anterior': anterior(); break;
        case 'aleatorio': estado.aleatorio = !estado.aleatorio; pintarBotones(); guardar(); break;
        case 'guardar': boton.setAttribute('aria-pressed', String(boton.getAttribute('aria-pressed') !== 'true')); break;
    }

    // Clic sobre la barra de progreso
    const barra = e.target.closest('[data-ui="barra"]');
    if (barra) {
        const r = barra.getBoundingClientRect();
        buscar(((e.clientX - r.left) / r.width) * pistas[estado.i].dur);
    }

    // Chips de filtro (pantalla Inicio)
    const chip = e.target.closest('[data-filtro]');
    if (chip) {
        const filtro = chip.dataset.filtro;
        $$('[data-filtro]').forEach((c) => c.setAttribute('aria-pressed', String(c === chip)));
        $$('[data-tipo]').forEach((c) => (c.hidden = filtro !== 'todo' && c.dataset.tipo !== filtro));
    }
});

// Teclado en la barra de progreso (role="slider")
document.addEventListener('keydown', (e) => {
    if (!e.target.matches('[data-ui="barra"]')) return;
    const dur = pistas[estado.i].dur;
    const mapa = {
        ArrowRight: estado.t + 5, ArrowUp: estado.t + 5,
        ArrowLeft: estado.t - 5, ArrowDown: estado.t - 5,
        Home: 0, End: dur - 1,
    };
    if (e.key in mapa) { e.preventDefault(); buscar(mapa[e.key]); }
});

document.addEventListener('input', (e) => {
    if (e.target.matches('[data-ui="volumen"]')) { estado.volumen = Number(e.target.value); guardar(); }
});

// Tema claro/oscuro, recordado en el navegador
document.getElementById('tema')?.addEventListener('click', () => {
    const raiz = document.documentElement;
    raiz.dataset.theme = raiz.dataset.theme === 'dark' ? 'light' : 'dark';
    try { localStorage.setItem('tema', raiz.dataset.theme); } catch (_) {}
});

/* ---------- Inicio ---------- */
cargar();
pintar();
pintarBotones();
if (estado.sonando) reproducir();
