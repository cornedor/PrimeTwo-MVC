<section class="docsIndex">

<div class="container">
	<div class="alert alert-warning">
		<strong><span class="fa fa-sticky-note-o"></span> TODO</strong>
		<br/>
		<ul>
			<li>Add documentation for migrations in the framework. </li>
			<li>Add documentation for advanced routing. </li>
			<li>Add documentation for HTML helpers. </li>
			<li>Add documentation for Namespaces. </li>
			<li>Add documentation for General file structure. </li>
			<li>Add documentation for Templating Views with layouts. </li>
		</ul>
	</div>

	<div class="row well">
		<div class="col-xs-12">
			<h2>Download & Installation</h2>
			<p>
				The easiest way to download the latest PrimeTwo MVC framework is by cloning our github repo:
				<pre><code class="bash">git clone https://github.com/PrimeTwo/primetwo-mvc.git </code></pre>
				Or download the latest version in a '.zip' file here.
			</p>
			<a href="http://github.com/PrimeTwo/PrimeTwo-MVC/archive/master.zip" class="btn btn-raised btn-small btn-success text-right"><span class="fa fa-download"></span> Download</a>
		</div>

		<div class="col-xs-12">

			<div class="row">
				<div class="col-sm-6">
					<p class="pull-left">
						To install the framework make sure you have the latest version of <a href="https://getcomposer.org/" target="_blank">Composer</a> installed. Then change directory to the framework root folder and run
						<code class="bash">composer update</code>. Composer will then download the latest dependencies for you.
					</p>
					<p>After running composer set your virtual host to the <code class="bash">/public</code> folder. Now you can see the default PrimeTwo placeholder when you go to your main app url.</p>
				</div>
				<div class="col-sm-6">
					<p class="alert alert-danger pull-right">
						<span class="fa fa-warning"></span> Warning!<br/>Never run a composer update on a deployment server. Use <code class="bash">composer install</code> instead.
					</p>
				</div>
			</div>
		</div>
	</div>

	<div class="row well">
		<div class="col-xs-12">
			<h2>Getting started</h2>
			<p>
				PrimeTwo is an MVC framework. MVC stands for Model, View and Controller. After installing the framework, take a glance around the project to familiarize yourself with the directory structure. The <code class="bash">/app</code> directory contains folders such as <code class="bash">views</code>, <code class="bash">controllers</code>, and <code class="bash">models</code>. Most of your application's code will reside somewhere in this directory. You may also wish to explore the <code class="bash">/app/config</code> directory and the configuration options that are available to you.
			</p>

			<h3>Routing</h3>
			<p>
				To get started, let's create our first route. In PrimeTwo, the simplest route is a route to a Closure. Pop open the <code class="bash">/app/routes</code> folder and create a new file. All the files in the <code class="bash">/app/routes</code> will be available in your application. This way you can organize your routes easily in multiple files. Let's add the following route to a new file called <code class="bash">default.php</code>:
				<pre><code class="language-php">Route::get('/home', function()
{
	return 'Primetwo!';
});
</code></pre>
			</p>
			<p>Now, if you hit the <code class=" language-php"><span class="token operator">/</span>users</code> route in your web browser, you should see <code class=" language-php">Users<span class="token operator">!</span></code> displayed as the response. Great! You've just created your first route.</p>
			<p>Routes can also be attached to controller classes. For example:</p>
			<pre class=" language-php"><code class=" language-php"><span class="token scope">Route<span class="token punctuation">::</span></span><span class="token function">get<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">,</span> <span class="token string">'UserController@getIndex'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
			<p>This route informs the framework that requests to the <code class=" language-php"><span class="token operator">/</span>users</code> route should call the <code class=" language-php">getIndex</code> method on the <code class=" language-php">UserController</code> class.
		</div>

		<div class="col-xs-12">
			<h3>Creating a View</h3>
			<p>
				Next, we'll create a simple view to display our user data. Views live in the <code class=" language-php">app<span class="token operator">/</span>views</code> directory and contain the HTML of your application. We're going to create a <code class="php">/app/views/layouts</code> folder and insert a <code class="php">main.php</code> file.				
			</p>
<pre><code class="html">&lt;!doctype html&gt;
&lt;html lang="en"&gt;
&lt;head&gt;
	&lt;meta charset="UTF-8"&gt;
	&lt;title&gt;My PrimeTwo layout&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
	&lt;?php View::render('home.index'); ?&gt;
&lt;/body&gt;
&lt;/html&gt;</code></pre>
			<p>As you can see their is another view being called to render inside this view. Let's create the <code class="php">home.index</code> view</p>
			<p>The dots in the view render stand for subdirectories. This means that we should create the <code class="php">index.php</code> inside <code class="bash">/app/views/home</code></p>
			<p>We can put in the following in the <code class="bash">index.php</code>:</p>
<pre><code class="html">&lt;section class="homepage"&gt;
	&lt;h2&gt;My PrimeTwo homepage!&lt;/h2&gt;
&lt;/section&gt;
</code></pre>
			<p> Now lets render the <code class="php">View</code> in the <code class="php">Route</code> we created earlier in <code class="bash">/app/routes/default.php</code>:</p>
<pre><code class="language-php">Route::get('/home', function()
{
	return View::render('layouts.main');
});
</code></pre>
			<p>Great! Visiting your domain on <code class="bash">/home</code> will render your <code class="php">Views</code>. </p>

			<h3>Controllers</h3>
			<p>Let's create a controller and call its method using our <code class="php">Route</code></p>
			<p>All controllers are based in <code class="bash">/app/controllers</code>, so lets create a <code class="php">HomeController.php</code>. Inside we insert the following code:</p>
<pre><code class="php">class HomeController extends Controller
{
	public function index(){
		View::render('layouts.main');
	}
}</code></pre>
			<p>Let's make sure our <code class="php">Route</code> calls the <code class="php">index</code> method. Change your <code class="php">default.php</code> <code class="php">Route</code> file to the folllwing:</p>
<pre><code class="php">Route::get('/home', 'index@HomeController');</code></pre>
			<p>And thats it! If you launch your app at <code class="php">/home</code> it will render your <code class="php">View</code></p>

			<h3>Models</h3>
			<p>To get started, create an Eloquent model. Models typically live in the <code class="php">/app/models</code> directory, but you are free to place them anywhere that can be auto-loaded according to your <code class="php">composer.json</code> file.</p>

			<h4>Defining An Eloquent Model</h4>

			<p>We need very little code to define a Eloquent Model. Let's create <code class="php">User.php</code> and insert:</p>

			<pre><code class="php">class User extends Eloquent {}</code></pre><br/>

			<p>Note that we did not tell Eloquent which table to use for our User model. The lower-case, plural name of the class will be used as the table name unless another name is explicitly specified. So, in this case, Eloquent will assume the User model stores records in the users table. You may specify a custom table by defining a table property on your model:</p>

<pre><code class="php">class User extends Eloquent {

protected $table = 'my_users';

}</code></pre>
			<p class="alert alert-warning">
				<span class="fa fa-comment"></span> Note: Eloquent will also assume that each table has a primary key column named id. You may define a primaryKey property to override this convention. Likewise, you may define a connection property to override the name of the database connection that should be used when utilizing the model.
			</p>

			<p>Once a model is defined, you are ready to start retrieving and creating records in your table. Note that you will need to place updated_at and created_at columns on your table by default. If you do not wish to have these columns automatically maintained, set the $timestamps property on your model to false.</p>

			<h4>Retrieving All Models</h4>

			<pre><code class="php">$users = User::all();</code></pre>

			<h4>Retrieving A Record By Primary Key</h4>

<pre><code class="php">$user = User::find(1);

var_dump($user->name);</code></pre>

			<p class="alert alert-warning">
				<span class="fa fa-comment"></span> Note: All methods available on the query builder are also available when querying Eloquent models.</p>

			<h4>Retrieving A Model By Primary Key Or Throw An Exception</h4>

			<p>Sometimes you may wish to throw an exception if a model is not found, allowing you to catch the exceptions and for example, display a 404 page.</p>
<pre><code class="php">$model = User::findOrFail(1);

$model = User::where('votes', '>', 100)->firstOrFail();</code></pre>

			<h4>Querying Using Eloquent Models</h4>
<pre><code class="php">$users = User::where('votes', '>', 100)->take(10)->get();

foreach ($users as $user)
{
	var_dump($user->name);
}</code></pre>

		</div>
	</div>



<!---->
<?php //foreach($docs as $doc): ?>
<!--	<div class="row">-->
<!--		<div class="col-lg-12">-->
<!--			<h2>--><?php //echo $doc->title; ?><!--</h2>-->
<!--			<p>--><?php //echo $doc->text; ?><!--</p>-->
<!--			<small>Last updated: --><?php //echo $doc->updated_at; ?><!--</small>-->
<!--		</div>-->
<!--	</div>		-->
<?php //endforeach; ?>
</div>

</section>