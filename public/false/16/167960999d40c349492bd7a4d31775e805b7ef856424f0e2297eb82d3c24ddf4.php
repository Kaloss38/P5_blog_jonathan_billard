<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* layouts/default.html.twig */
class __TwigTemplate_ab874612c92aff250728dccefdf7aa9d7c8dc020ae767fd758a12d7324e8c153 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'stylesheets' => [$this, 'block_stylesheets'],
            'body' => [$this, 'block_body'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!doctype html>
<html lang=\"fr\">
  <head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">
    <link rel=\"icon\" href=\"/docs/4.0/assets/img/favicons/favicon.ico\">

    <title>";
        // line 10
        $this->displayBlock('title', $context, $blocks);
        echo "</title>

    <link rel=\"canonical\" href=\"https://getbootstrap.com/docs/4.0/examples/sticky-footer-navbar/\">

    ";
        // line 14
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 17
        echo "    <!-- Bootstrap core CSS -->
    <link href=\"../../dist/css/bootstrap.min.css\" rel=\"stylesheet\">

    <!-- Custom styles for this template -->
    <link href=\"sticky-footer-navbar.css\" rel=\"stylesheet\">
  </head>

  <body>
    ";
        // line 25
        $this->displayBlock('body', $context, $blocks);
        // line 72
        echo "  </body>
</html>
";
    }

    // line 10
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Mon titre ";
    }

    // line 14
    public function block_stylesheets($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 15
        echo "            <link rel=\"stylesheet\" type=\"text/css\" href=\"/css/base.css\"/>
    ";
    }

    // line 25
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 26
        echo "    <header>
      <!-- Fixed navbar -->
      <nav class=\"navbar navbar-expand-md navbar-dark fixed-top bg-dark\">
        <a class=\"navbar-brand\" href=\"#\">Fixed navbar</a>
        <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarCollapse\" aria-controls=\"navbarCollapse\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
          <span class=\"navbar-toggler-icon\"></span>
        </button>
        <div class=\"collapse navbar-collapse\" id=\"navbarCollapse\">
          <ul class=\"navbar-nav mr-auto\">
            <li class=\"nav-item active\">
              <a class=\"nav-link\" href=\"#\">Home <span class=\"sr-only\">(current)</span></a>
            </li>
            <li class=\"nav-item\">
              <a class=\"nav-link\" href=\"#\">Link</a>
            </li>
            <li class=\"nav-item\">
              <a class=\"nav-link disabled\" href=\"#\">Disabled</a>
            </li>
          </ul>
          <form class=\"form-inline mt-2 mt-md-0\">
            <input class=\"form-control mr-sm-2\" type=\"text\" placeholder=\"Search\" aria-label=\"Search\">
            <button class=\"btn btn-outline-success my-2 my-sm-0\" type=\"submit\">Search</button>
          </form>
        </div>
      </nav>
    </header>

    <!-- Begin page content -->
    <main role=\"main\" class=\"container\">
      ";
        // line 55
        $this->displayBlock('content', $context, $blocks);
        // line 56
        echo "    </main>

    <footer class=\"footer\">
      <div class=\"container\">
        <span class=\"text-muted\">Place sticky footer content here.</span>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src=\"https://code.jquery.com/jquery-3.2.1.slim.min.js\" integrity=\"sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN\" crossorigin=\"anonymous\"></script>
    <script>window.jQuery || document.write('<script src=\"../../assets/js/vendor/jquery-slim.min.js\"><\\/script>')</script>
    <script src=\"../../assets/js/vendor/popper.min.js\"></script>
    <script src=\"../../dist/js/bootstrap.min.js\"></script>
    ";
    }

    // line 55
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function getTemplateName()
    {
        return "layouts/default.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  151 => 55,  132 => 56,  130 => 55,  99 => 26,  95 => 25,  90 => 15,  86 => 14,  79 => 10,  73 => 72,  71 => 25,  61 => 17,  59 => 14,  52 => 10,  41 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "layouts/default.html.twig", "C:\\wamp64\\www\\src\\Views\\layouts\\default.html.twig");
    }
}
