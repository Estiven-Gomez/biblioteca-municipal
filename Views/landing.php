<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Biblioteca Pública Municipal Simijaca, un espacio de lectura, aprendizaje y encuentro cultural.">
    <title>eLector | Biblioteca Pública Municipal Simijaca</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/css/landing.css">
</head>
<body>
    <header class="site-header">
        <a class="brand" href="<?php echo base_url; ?>" aria-label="eLector, Biblioteca Pública Municipal Simijaca, inicio">
            <img class="brand-logo" src="<?php echo base_url; ?>Assets/img/logo.png" alt="Logo de eLector">
            <span class="brand-copy">
                <strong>eLector</strong>
                <small>Biblioteca Pública · Simijaca</small>
            </span>
        </a>
        <nav class="site-nav" aria-label="Navegación principal">
            <a href="#actualidad">Actualidad</a>
            <a href="#territorio">Territorio</a>
            <a href="#cultura">Cultura</a>
            <a href="#patrimonio">Patrimonio</a>
        </nav>
        <a class="login-link" href="<?php echo base_url; ?>Home/login">
            <i class="fa fa-sign-in" aria-hidden="true"></i>
            <span>Iniciar sesión</span>
        </a>
    </header>

    <main>
        <section class="hero" style="--hero-image: url('<?php echo base_url; ?>Assets/img/simijaca-casa-cultura.png');">
            <div class="hero-content">
                <p class="eyebrow"><span></span> CASA DE LA CULTURA · SIMIJACA</p>
                <h1>Biblioteca Pública Municipal Simijaca</h1>
                <p class="hero-description">Un espacio de la Casa de la Cultura para leer, aprender y encontrarnos.</p>
                <a class="hero-link" href="#biblioteca">Conoce nuestra biblioteca <i class="fa fa-long-arrow-down" aria-hidden="true"></i></a>
            </div>
            <p class="hero-caption">Casa de la Cultura · Simijaca</p>
        </section>

        <section class="intro-section" id="biblioteca">
            <div class="intro-copy">
                <p class="eyebrow eyebrow-dark">LECTURA, HISTORIA Y COMUNIDAD</p>
                <h2>Un lugar para leer y encontrarnos.</h2>
                <p>La Biblioteca Pública hace parte de la Casa de la Cultura de Simijaca: un espacio para acercarse a los libros, compartir saberes y mantener viva la memoria del municipio.</p>
            </div>
        </section>

        <section class="news-section" id="actualidad">
            <div class="section-heading">
                <p class="eyebrow eyebrow-dark">INFORMACIÓN MUNICIPAL</p>
                <h2>Actualidad y novedades</h2>
                <p class="section-description">Noticias, actividades y convocatorias publicadas por las entidades del municipio.</p>
            </div>
            <div class="news-grid">
                <article class="news-card">
                    <img class="news-card-image" src="<?php echo base_url; ?>Assets/img/simijaca-parque-maravillas.jpg" alt="Trabajo rural y cultivos en Simijaca" loading="lazy">
                    <p class="card-kicker">CAMPO Y SOSTENIBILIDAD · 2026</p>
                    <h3>Prácticas sostenibles para productores de Simijaca</h3>
                    <p>En septiembre de 2026, la Gobernación informó sobre la entrega de insumos para parcelas de abonos verdes y biofábricas en el municipio.</p>
                    <a class="card-link" href="https://www.cundinamarca.gov.co/noticias/simijaca-implementara-46-parcelas-de-abonos-verdes-y-10-biofabricas" target="_blank" rel="noopener noreferrer">Leer noticia en la Gobernación <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                </article>
                <article class="news-card">
                    <img class="news-card-image" src="<?php echo base_url; ?>Assets/img/simijaca-montana-2026.jpg" alt="Vista de las montañas de Simijaca entre nubes" loading="lazy">
                    <p class="card-kicker">MUNICIPIO · PUBLICACIÓN RECIENTE</p>
                    <h3>Simijaca se descubre desde las alturas</h3>
                    <p>La Alcaldía comparte imágenes y novedades del municipio en sus canales oficiales.</p>
                    <a class="card-link" href="https://www.facebook.com/AlcdSimijaca/" target="_blank" rel="noopener noreferrer">Ver publicaciones de la Alcaldía <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                </article>
                <article class="news-card news-card-cta">
                    <img class="news-card-image" src="<?php echo base_url; ?>Assets/img/simijaca-convocatoria-femes-2026.png" alt="Convocatoria FEMES 2026-2 de la Alcaldía de Simijaca" loading="lazy">
                    <span class="news-icon" aria-hidden="true"><i class="fa fa-bullhorn"></i></span>
                    <p class="card-kicker">AGENDA Y CONVOCATORIAS</p>
                    <h3>Entérate de las novedades</h3>
                    <p>Consulta fechas, requisitos y disponibilidad directamente en los medios oficiales antes de participar.</p>
                    <a class="card-link" href="https://www.simijaca-cundinamarca.gov.co/" target="_blank" rel="noopener noreferrer">Ir al sitio oficial <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                </article>
            </div>
        </section>

        <section class="places-section" id="territorio">
            <div class="section-heading">
                <p class="eyebrow eyebrow-dark">POSTALES RECIENTES · 2026</p>
                <h2>Simijaca, tierra de paisajes</h2>
                <p class="section-description">Montañas, agua y vida rural en imágenes compartidas por la Alcaldía Municipal.</p>
            </div>
            <div class="place-gallery">
                <figure class="place-photo">
                    <img src="<?php echo base_url; ?>Assets/img/simijaca-parque-maravillas.jpg" alt="Paisaje rural de Simijaca con cultivos, ganado y montañas" loading="lazy">
                    <figcaption>Vida rural · abril de 2026 <a href="https://www.facebook.com/photo/?fbid=1257954593192275&amp;set=a.332677579053319" target="_blank" rel="noopener noreferrer">Fuente: Alcaldía de Simijaca</a></figcaption>
                </figure>
                <figure class="place-photo">
                    <img src="<?php echo base_url; ?>Assets/img/simijaca-cascada-2026.jpg" alt="Cascada rodeada de vegetación en el paisaje de Simijaca" loading="lazy">
                    <figcaption>Cascada y vegetación · 2026 <a href="https://www.simijaca-cundinamarca.gov.co/SliderHome/WhatsApp%20Image%202026-02-24%20at%207.23.27%20PM.jpeg" target="_blank" rel="noopener noreferrer">Fuente: Alcaldía Municipal</a></figcaption>
                </figure>
                <figure class="place-photo">
                    <img src="<?php echo base_url; ?>Assets/img/simijaca-montana-2026.jpg" alt="Montaña y valle de Simijaca entre nubes" loading="lazy">
                    <figcaption>Paisaje montañoso · 2026 <a href="https://www.simijaca-cundinamarca.gov.co/SliderHome/WhatsApp%20Image%202026-02-24%20at%207.23.27%20PM.jpeg" target="_blank" rel="noopener noreferrer">Fuente: Alcaldía Municipal</a></figcaption>
                </figure>
            </div>
        </section>

        <section class="culture-section" id="cultura">
            <div class="section-heading">
                <p class="eyebrow eyebrow-dark">CASA DE LA CULTURA</p>
                <h2>Aprender, crear y compartir</h2>
                <p class="section-description">La formación artística acerca distintas expresiones y saberes a personas de todas las edades.</p>
            </div>
            <a class="culture-showcase" href="https://www.youtube.com/watch?v=o3zrErltBkQ" target="_blank" rel="noopener noreferrer">
                <img src="<?php echo base_url; ?>Assets/img/simijaca-grupo-danza.png" alt="Grupo de danza de Simijaca con trajes tradicionales frente a la iglesia" loading="lazy">
                <span class="culture-showcase-copy">
                    <span class="culture-number">DANZA · CASA DE LA CULTURA</span>
                    <span class="culture-showcase-title">La cultura se vive y se comparte</span>
                    <span class="culture-showcase-link">Ver presentación <i class="fa fa-play-circle" aria-hidden="true"></i></span>
                </span>
            </a>
            <div class="culture-grid">
                <article class="culture-card">
                    <span class="culture-number">01 · MÚSICA</span>
                    <h3>Ritmo y sonidos</h3>
                    <p>Un espacio para acercarse a la música, los instrumentos y las expresiones sonoras de la región.</p>
                </article>
                <article class="culture-card">
                    <span class="culture-number">02 · DANZA</span>
                    <h3>Movimiento y tradición</h3>
                    <p>Explora el movimiento y las danzas que hacen parte de la memoria cultural del territorio.</p>
                </article>
                <article class="culture-card">
                    <span class="culture-number">03 · ARTES ESCÉNICAS</span>
                    <h3>Teatro y narración</h3>
                    <p>La expresión corporal y la palabra abren caminos para contar historias y compartir ideas.</p>
                </article>
                <article class="culture-card">
                    <span class="culture-number">04 · ARTES PLÁSTICAS</span>
                    <h3>Crear con las manos</h3>
                    <p>Dibujo, color y creación manual para expresar la identidad y la imaginación local.</p>
                </article>
            </div>
            <p class="section-note">La oferta, las inscripciones y los horarios pueden cambiar. Confírmalos con la Casa de la Cultura.</p>
            <a class="section-button" href="https://www.facebook.com/AlcdSimijaca/" target="_blank" rel="noopener noreferrer">Consultar novedades culturales <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
        </section>

        <section class="heritage-section" id="patrimonio">
            <div class="section-heading">
                <p class="eyebrow eyebrow-dark">MEMORIA DEL TERRITORIO</p>
                <h2>Hitos del patrimonio de Simijaca</h2>
                <p class="section-description">Lugares y paisajes para conocer la historia y la riqueza natural del municipio.</p>
            </div>
            <div class="heritage-grid">
                <article class="heritage-card">
                    <img src="<?php echo base_url; ?>Assets/img/simijaca-montana-2026.jpg" alt="Montañas y valle de Simijaca" loading="lazy">
                    <span>01 · TERRITORIO Y MEMORIA</span>
                    <h3>Montañas de Simijaca</h3>
                    <p>El paisaje montañoso acompaña la vida de las veredas y del casco urbano.</p>
                </article>
                <article class="heritage-card">
                    <img src="<?php echo base_url; ?>Assets/img/simijaca-cascada-2026.jpg" alt="Caída de agua entre rocas y vegetación" loading="lazy">
                    <span>02 · PATRIMONIO NATURAL</span>
                    <h3>Agua y vegetación</h3>
                    <p>Una muestra de los paisajes naturales que rodean el municipio.</p>
                </article>
                <article class="heritage-card">
                    <img src="<?php echo base_url; ?>Assets/img/simijaca-parque-maravillas.jpg" alt="Paisaje de las zonas rurales de Simijaca" loading="lazy">
                    <span>03 · VIDA CAMPESINA</span>
                    <h3>Veredas y vida rural</h3>
                    <p>Los paisajes agrícolas hacen parte de la identidad cotidiana de Simijaca.</p>
                </article>
                <article class="heritage-card">
                    <img src="<?php echo base_url; ?>Assets/img/simijaca-parque.jpg" alt="Parque principal y templo parroquial de Simijaca" loading="lazy">
                    <span>04 · MEMORIA ARQUITECTÓNICA</span>
                    <h3>Parque y parroquia</h3>
                    <p>Un conjunto emblemático del centro histórico y la vida del municipio.</p>
                    <a class="heritage-credit" href="https://commons.wikimedia.org/wiki/File:Simijaca_Parque.JPG" target="_blank" rel="noopener noreferrer">Foto: Petruss / dominio público</a>
                </article>
            </div>
        </section>

        <section class="services-section" id="servicios">
            <div class="section-heading">
                <p class="eyebrow eyebrow-dark">BIBLIOTECA Y CULTURA</p>
                <h2>Un espacio para descubrir</h2>
            </div>
            <div class="service-list">
                <article class="service-item">
                    <span class="service-icon icon-green"><i class="fa fa-book" aria-hidden="true"></i></span>
                    <h3>Lectura para todos</h3>
                    <p>Acércate a los libros, explora nuevos temas y encuentra un espacio para disfrutar la lectura.</p>
                </article>
                <article class="service-item">
                    <span class="service-icon icon-blue"><i class="fa fa-search" aria-hidden="true"></i></span>
                    <h3>Consulta y aprendizaje</h3>
                    <p>Un punto de encuentro para buscar información, aprender y compartir conocimientos.</p>
                </article>
                <article class="service-item">
                    <span class="service-icon icon-gold"><i class="fa fa-users" aria-hidden="true"></i></span>
                    <h3>Memoria local</h3>
                    <p>Un punto de partida para conocer el patrimonio, las tradiciones campesinas y la identidad cultural de Simijaca.</p>
                </article>
            </div>
        </section>

        <section class="access-band">
            <div>
                <p class="eyebrow">TU BIBLIOTECA TE ESPERA</p>
                <h2>Las próximas historias empiezan aquí.</h2>
            </div>
            <a class="access-button" href="<?php echo base_url; ?>Home/login">Entrar a la plataforma <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
        </section>
    </main>

    <footer class="site-footer">
        <span>eLector · Biblioteca Pública Municipal Simijaca</span>
        <span>Casa de la Cultura · Simijaca, Cundinamarca</span>
        <span class="photo-credit">
            Paisaje rural · abril de 2026: <a href="https://www.facebook.com/photo/?fbid=1257954593192275&amp;set=a.332677579053319" target="_blank" rel="noopener noreferrer">Alcaldía de Simijaca</a>.
            Paisajes de montaña y cascada · febrero de 2026: <a href="https://www.simijaca-cundinamarca.gov.co/SliderHome/WhatsApp%20Image%202026-02-24%20at%207.23.27%20PM.jpeg" target="_blank" rel="noopener noreferrer">Alcaldía Municipal de Simijaca</a>.
        </span>
    </footer>
</body>
</html>