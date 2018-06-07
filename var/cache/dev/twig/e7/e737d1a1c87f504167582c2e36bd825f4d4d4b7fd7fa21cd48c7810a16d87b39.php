<?php

/* DrDohTicketBundle:Default:ticketForm.html.twig */
class __TwigTemplate_562d4c727d653214d27c8515cc4128a6cee025faeb28511d34ed8b74a2028d6b extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("::layout.html.twig", "DrDohTicketBundle:Default:ticketForm.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "DrDohTicketBundle:Default:ticketForm.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "DrDohTicketBundle:Default:ticketForm.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo " 
    ";
        // line 4
        $this->displayParentBlock("title", $context, $blocks);
        echo " Billetterie 
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 7
    public function block_body($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 8
        echo "
    <div class=\"container\">
        <h2 class=\"text-white m-4\">Bienvenue</h2> 
        <div id=\"form_contener\"></div>
    
        <div class=\"card text-white bg-dark mb-3\">
            <h3 class=\"card-header text-center\">
                Choissiez la date de votre visite
            </h3>
            <div class=\"card-body\">
                <div class=\"well\">
                    <form method=\"post\" action=\"";
        // line 19
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("dr_doh_ticket_billetterie_2");
        echo "\">
                        <div class=\"form-group\">    
                            <label for=\"ticket_qte\">Nombre de places (Maximum 6)</label><br />
                            <select name=\"ticket_qte\" id=\"ticket_qte\" class=\"form-control\">
                                <option value=\"1\">1</option>
                                <option value=\"2\">2</option>
                                <option value=\"3\">3</option>
                                <option value=\"4\">4</option>
                                <option value=\"5\">5</option>
                                <option value=\"6\">6</option>
                            </select>
                        
                        <hr>
                        
                        <div class=\"form-group\">  
                            <label for=\"choix\">Durée de votre visite</label>
                            <select name=\"choix\" id=\"choix\" class=\"form-control\">
                                <option value=\"journee\">Billet journée</option>
                                <option value=\"demi-journee\">Billet demi journée (a partir de 14h00)</option>
                            </select>
                        </div>
                        
                        <hr>
                        
                        <div class=\"form-group\">
                            <label>Date de votre visite</label>
                            <div class=\"input-group date\" id=\"datetimepicker1\" data-target-input=\"nearest\">
                                <input type=\"text\" name=\"date\" class=\"form-control datetimepicker-input\" data-target=\"#datetimepicker1\"/>
                                <div class=\"input-group-append\" data-target=\"#datetimepicker1\" data-toggle=\"datetimepicker\">
                                    <div class=\"input-group-text\"><i class=\"fa fa-calendar\"></i></div>
                                </div>
                            </div>
                        </div>
   

                        <div class=\"form-group mt-5\">
                            <input type=\"submit\" class=\"form-control btn btn-info\" value=\"Poursuivre\">
                        </div>

                    </form>
                </div>
        </div>
        
    </div> 

";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 66
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        // line 67
        echo "
    ";
        // line 68
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <script type=\"text/javascript\">
        \$(function () {

            \$('#datetimepicker1').datetimepicker(
                {
                format: 'L',
                viewDate: 'moment',
                locale: 'fr',
                disabledDates: [
                    ";
        // line 79
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["listFullDate"]) || array_key_exists("listFullDate", $context) ? $context["listFullDate"] : (function () { throw new Twig_Error_Runtime('Variable "listFullDate" does not exist.', 79, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["fullDate"]) {
            // line 80
            echo "                    \"";
            echo twig_escape_filter($this->env, $context["fullDate"], "html", null, true);
            echo "\" ,
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['fullDate'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 82
        echo "                    \"99/99/9999 99:99\"
                ]});
        
        // --VVV-- Reglage de la date mini de reservation --VVV-- 
        \$('#datetimepicker1').datetimepicker('minDate', 'moment');

        // --VVV-- Reglage format de la date --VVV-- 
        \$('#datetimepicker1').datetimepicker('format', 'DD/MM/YYYY');
        });
    </script>

";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "DrDohTicketBundle:Default:ticketForm.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  186 => 82,  177 => 80,  173 => 79,  159 => 68,  156 => 67,  147 => 66,  91 => 19,  78 => 8,  69 => 7,  57 => 4,  46 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"::layout.html.twig\"%}

{% block title %} 
    {{parent()}} Billetterie 
{% endblock %}

{% block body  %}

    <div class=\"container\">
        <h2 class=\"text-white m-4\">Bienvenue</h2> 
        <div id=\"form_contener\"></div>
    
        <div class=\"card text-white bg-dark mb-3\">
            <h3 class=\"card-header text-center\">
                Choissiez la date de votre visite
            </h3>
            <div class=\"card-body\">
                <div class=\"well\">
                    <form method=\"post\" action=\"{{path('dr_doh_ticket_billetterie_2')}}\">
                        <div class=\"form-group\">    
                            <label for=\"ticket_qte\">Nombre de places (Maximum 6)</label><br />
                            <select name=\"ticket_qte\" id=\"ticket_qte\" class=\"form-control\">
                                <option value=\"1\">1</option>
                                <option value=\"2\">2</option>
                                <option value=\"3\">3</option>
                                <option value=\"4\">4</option>
                                <option value=\"5\">5</option>
                                <option value=\"6\">6</option>
                            </select>
                        
                        <hr>
                        
                        <div class=\"form-group\">  
                            <label for=\"choix\">Durée de votre visite</label>
                            <select name=\"choix\" id=\"choix\" class=\"form-control\">
                                <option value=\"journee\">Billet journée</option>
                                <option value=\"demi-journee\">Billet demi journée (a partir de 14h00)</option>
                            </select>
                        </div>
                        
                        <hr>
                        
                        <div class=\"form-group\">
                            <label>Date de votre visite</label>
                            <div class=\"input-group date\" id=\"datetimepicker1\" data-target-input=\"nearest\">
                                <input type=\"text\" name=\"date\" class=\"form-control datetimepicker-input\" data-target=\"#datetimepicker1\"/>
                                <div class=\"input-group-append\" data-target=\"#datetimepicker1\" data-toggle=\"datetimepicker\">
                                    <div class=\"input-group-text\"><i class=\"fa fa-calendar\"></i></div>
                                </div>
                            </div>
                        </div>
   

                        <div class=\"form-group mt-5\">
                            <input type=\"submit\" class=\"form-control btn btn-info\" value=\"Poursuivre\">
                        </div>

                    </form>
                </div>
        </div>
        
    </div> 

{% endblock %}

{% block javascripts %}

    {{parent()}}

    <script type=\"text/javascript\">
        \$(function () {

            \$('#datetimepicker1').datetimepicker(
                {
                format: 'L',
                viewDate: 'moment',
                locale: 'fr',
                disabledDates: [
                    {% for fullDate in listFullDate %}
                    \"{{fullDate}}\" ,
                    {% endfor %}
                    \"99/99/9999 99:99\"
                ]});
        
        // --VVV-- Reglage de la date mini de reservation --VVV-- 
        \$('#datetimepicker1').datetimepicker('minDate', 'moment');

        // --VVV-- Reglage format de la date --VVV-- 
        \$('#datetimepicker1').datetimepicker('format', 'DD/MM/YYYY');
        });
    </script>

{% endblock %}
    
", "DrDohTicketBundle:Default:ticketForm.html.twig", "/Applications/MAMP/htdocs/Projet4/src/DrDoh/TicketBundle/Resources/views/Default/ticketForm.html.twig");
    }
}
