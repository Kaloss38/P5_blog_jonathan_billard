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

/* layouts/default.twig */
class __TwigTemplate_575fa4cd2f87b30087b717c81dd6735da0d4240f1ed60051f897d3b7aaa4a868 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "
<!doctype html>
<html lang=\"en\">
  <head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">
    <link rel=\"icon\" href=\"/docs/4.0/assets/img/favicons/favicon.ico\">

    <title>Sticky Footer Navbar Template for Bootstrap</title>

    <link rel=\"canonical\" href=\"https://getbootstrap.com/docs/4.0/examples/sticky-footer-navbar/\">

    <!-- Bootstrap core CSS -->
    <link href=\"../../dist/css/bootstrap.min.css\" rel=\"stylesheet\">

    <!-- Custom styles for this template -->
    <link href=\"sticky-footer-navbar.css\" rel=\"stylesheet\">
  </head>

  <body>

    <header>
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
        // line 53
        $this->displayBlock(($context["content"] ?? null), $context, $blocks);
        echo "
    </main>

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
  </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "layouts/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  91 => 53,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "layouts/default.twig", "C:\\wamp64\\www\\src\\Views\\layouts\\default.twig");
    }
}
