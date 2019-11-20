<?php
include_once "includes/include-all.inc.php";
?>
<?php
$title = "Rent a car";
include_once "views/head.php";
?>
<main>
<?php
$veiculos = Veiculo::getAll(5);
if(count($veiculos)>0) {
?>
	<section class="slider">
		<div class="section-title"></div>
		<div class="section-content">
<?php
	foreach($veiculos as $veiculo) {
		$marca = (Marca::get($veiculo->idMarca))->nomeMarca;
?>
			<div class="slide" data-timeout="5000">
				<div class="slide-background">
					<img src="uploads/<?php echo $veiculo->fotoVeiculo; ?>">
				</div>
				<div class="slide-content" style="padding-top: 80px;">
					<div class="slide-content-container">
						<div class="slide-title">
							<h1><?php echo $veiculo->modeloVeiculo; ?></h1>
						</div>
						<div class="slide-text">
							<p><i><?php echo $veiculo->modeloVeiculo; ?> (<?php echo $marca; ?>)</i></p>
						</div>
						<div class="slide-options">
							<a href="#" class="button-2 button-large"><i class="material-icons">credit_card</i> R$ <?php echo $veiculo->valorDiariaVeiculo; ?>/dia</a>
						    <a href="#" class="button-1 button-large"><i class="material-icons">headset_mic</i> Entrar em contato</a>
                        </div>
					</div>
				</div>
			</div>
<?php
	}
?>
		</div>
		<div class="section-pos">
			<div class="change-slide"></div>
			<div class="slide-timer"></div>
		</div>
	</section>
<?php
}
?>
    <!--section class="slider">
		<div class="section-content">
			<div class="slide" data-timeout="0">
				<div class="slide-background">
					<img src="assets/images/ferrari.jpeg">
				</div>
				<div class="slide-content slide-center">
					<div class="slide-content-container">
						<div class="slide-title">
							<h1>Aluguel de veículo com desconto na primeira vez!</h1>
						</div>
						<div class="slide-text">
							<h2 class="countdown" data-countdown="Thu Dec 19 2019 00:00:00 GMT-0300 (Horário Padrão de Brasília)" data-year-string="%year%y " data-year-pad="0" data-month-string="%month%mon " data-month-pad="0" data-day-string="%day%d " data-day-pad="0" data-hour-string="%hour%h " data-hour-pad="2" data-minute-string="%minute%min " data-minute-pad="2" data-second-string="%second%s" data-second-pad="2" data-millisecond-string="%millisecond%ms" data-millisecond-pad="3" data-format="%if-year-string%%if-month-string%%if-day-string%%hour-string%%minute-string%%second-string% remaining" data-remove-first-zero="true" data-expire-message="Infelizmente a promoção acabou :(" data-rate="1000"></h2>
						</div>
						<div class="slide-options">
							<a href="#" class="button-1 button-large">Aproveitar</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="section-pos">
			<div class="slide-timer" style="width:50%;"></div>
		</div>
	</section-->
	<section class="news">
		<div class="section-title">Veículos</div>
		<div class="section-content">
<?php
$veiculos = Veiculo::getAll(0);
foreach($veiculos as $veiculo) {
    $marca = (Marca::get($veiculo->idMarca))->nomeMarca;
?>
			<article>
				<div class="article-image">
					<img src="uploads/<?php echo $veiculo->fotoVeiculo; ?>">
					<!--div class="rating" data-rating="9/10">9 de 10</div-->
				</div>
				<div class="article-content">
					<div class="article-title">
						<h1><?php echo $veiculo->modeloVeiculo; ?></h1><!--span class="article-date"><i class="material-icons">calendar_today</i> Today</span-->
					</div>
					<div class="article-tags">
						<i class="material-icons">local_offer</i>
						<a href="#"><?php echo $marca; ?></a>
					</div>
					<div class="article-text">
						<!--p>Nullam at hendrerit neque. Integer aliquet dignissim sagittis. Etiam vulputate venenatis bibendum. Pellentesque faucibus vestibulum nisl.</p>
						<p>Aenean consectetur consectetur tortor, sit amet euismod nulla vestibulum id. Suspendisse finibus tortor et libero varius, nec ultricies.</p-->
					</div>
					<div class="article-options">
                        <a href="#" class="button-1"><i class="material-icons">headset_mic</i> Entrar em contato</a><br><br>
                        <a href="#" class="button-2 button-large"><i class="material-icons">credit_card</i> R$ <?php echo $veiculo->valorDiariaVeiculo; ?>/dia</a>
					</div>
				</div>
			</article>
<?php
}
?>
		</div>
	</section>
	<section class="slider">
		<div class="section-title"></div>
		<div class="section-content">
			<div class="slide" data-timeout="0">
				<div class="slide-background">
					<img src="assets/images/porsche.jpeg">
				</div>
				<div class="slide-content" style="padding-top: 80px;">
					<div class="slide-content-container">
						<div class="slide-title">
							<h1>Porque alugar conosco?</h1>
						</div>
						<div class="slide-text">
							<p></p>
						</div>
						<div class="slide-options">
							<section class="features">
								<div class="section-title"></div>
								<div class="section-content">
									<div class="feature feature-4">
										<div class="feature-content">
											<div class="feature-icon">
												<i class="material-icons">credit_card</i>
											</div>
											<div class="feature-title"><h1>Pagamento</h1></div>
											<div class="feature-text">
												<p>Múltiplas formas de pagamento, como boleto, etc.</p>
											</div>
										</div>
									</div>
									<div class="feature feature-4">
										<div class="feature-content">
											<div class="feature-icon">
												<i class="material-icons">money</i>
											</div>
											<div class="feature-title"><h1>Investimento</h1></div>
											<div class="feature-text">
												<p>Obtenha um retorno trabalhando para apps de transporte</p>
											</div>
										</div>
									</div>
									<div class="feature feature-4">
										<div class="feature-content">
											<div class="feature-icon">
												<i class="material-icons">supervisor_account</i>
											</div>
											<div class="feature-title"><h1>Comunidade incrível</h1></div>
											<div class="feature-text">
												<p>Muitos clientes utilizam nosso serviço</p>
											</div>
										</div>
									</div>
									<div class="feature feature-4">
										<div class="feature-content">
											<div class="feature-icon">
												<i class="material-icons">headset_mic</i>
											</div>
											<div class="feature-title"><h1>Suporte</h1></div>
											<div class="feature-text">
												<p>Suporte online e por telefone, rápido 24 horas por dia</p>
											</div>
										</div>
									</div>
								</div>
							</section>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
<?php
include_once "views/foot.php";
?>
