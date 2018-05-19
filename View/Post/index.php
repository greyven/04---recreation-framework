<?php $this->title = 'Mon blog - '.$this->clean($post['post_title']); ?>

<article class="post shadow">

	<header class="postTitle verticalAlignCenter" style="background-image: url('Content/Images/post/<?= $this->clean($post['post_image']); ?>')" >
		<h1 class="postLink"><?= $this->clean($post['post_title']); ?></h1>
	</header>
	<p class="postContent"><?= $this->clean($post['post_content']); ?></p>
	<footer class="postFooter verticalAlignCenter">
		<div class="postFooterText">
			Jean Forteroche, le
			<time><?= $this->clean($post['post_date']); ?></time>
		</div>
	</footer>
</article>
<hr class="shadow" />
<div class="comments shadow">
	<div class="row commentsContent">
		<header class="commHeader">
			<h1 id="responsesTitle">Réponses à <?= $this->clean($post['post_title']); ?></h1>
		</header>
		<div class="commBody">
			<?php
				foreach ($comments as $oneComment)
				{
					?>
					<div class="comment">
						<div class="container">
							<div class="row">
								<div class="col-lg-6 commAuthor">
									<strong><?= $this->clean($oneComment['comm_author']); ?> dit: </strong><br/>
								</div>
								<?php
									if(isset($_SESSION['user_id']))
									{
										?>
										<div class="col-lg-6 commReport">
											<?php
												if($this->clean($oneComment['comm_reported']))
												{
													?>
													[<span class="reported">Déjà signalé</span>]
													<?php
												}
												else
												{
													?>
													[
													<a href="post/report/<?= $post['post_id'] ?>/<?= $oneComment['comm_id'] ?>">
														<span class="notReported">Signaler</span>
													</a>
													]
													<?php
												}
											?>
										</div>
										<?php
									}
								?>
							</div>
							<div class="row">
								<div class="col-lg-12 commContent">
									<?= $this->clean($oneComment['comm_content']); ?>
								</div>
							</div>
						</div>
					</div>
					<?php
				}
			?>
		</div>
		<div class="commFooter">
			<form method="post" action="post/toComment/">
				<input id="author" name="comm_author" type="text" placeholder="Votre pseudo" required/>
				<br/>
				<textarea id="txtComment" name="comm_content" rows="6" placeholder="Votre commentaire" required></textarea>
				<br/>
				<input type="hidden" name="post_id" value="<?= $post['post_id'] ?>"/>
				<input type="submit" value="Valider"/>
			</form>
		</div>
	</div>
</div>