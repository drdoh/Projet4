<?php

/* DrDohTicketBundle:Default:guestForm.html.twig */
class __TwigTemplate_bea892fd208d1ef52e939d78b2c6e3642c3e0235632414f31e67c4cb1cf47240 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("::layout.html.twig", "DrDohTicketBundle:Default:guestForm.html.twig", 1);
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "DrDohTicketBundle:Default:guestForm.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "DrDohTicketBundle:Default:guestForm.html.twig"));

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
        echo "   <div class=\"container\">
        <h2 class=\"text-white m-4\">Bienvenue</h2> 
   
        <div class=\"card text-white bg-dark mb-3\">
            <h3 class=\"card-header text-center\">
            <em>
                Vous prevoyez une visite pour la ";
        // line 14
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new Twig_Error_Runtime('Variable "app" does not exist.', 14, $this->source); })()), "request", array()), "request", array()), "get", array(0 => "choix"), "method"), "html", null, true);
        echo " du ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new Twig_Error_Runtime('Variable "app" does not exist.', 14, $this->source); })()), "request", array()), "request", array()), "get", array(0 => "date"), "method"), "html", null, true);
        echo " <br>
                <br>
                Indiquez vos coordonnées pour la reservation de ";
        // line 16
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new Twig_Error_Runtime('Variable "app" does not exist.', 16, $this->source); })()), "request", array()), "request", array()), "get", array(0 => "ticket_qte"), "method"), "html", null, true);
        echo " billet(s).  
            <em>
            </h3>
            <div class=\"card-body\">
                <div class=\"well\">
                    ";
        // line 21
        echo         $this->env->getRuntime('Symfony\Bridge\Twig\Form\TwigRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new Twig_Error_Runtime('Variable "form" does not exist.', 21, $this->source); })()), 'form');
        echo "

                </div>
            </div>
        </div>

        <br>
        
        <div class=\"card text-white bg-dark mb-3\">
            <h3 class=\"card-header text-center\">
                Montant de votre commande
            </h3>
            <div class=\"card-body\">
                <div class=\"well text-dark\">
                    <table class=\"table table-striped table-light table-bordered\">
                        <thead>
                            <tr>
                            <th scope=\"col\">Billets</th>
                            <th scope=\"col\">Quantité</th>
                            <th scope=\"col\">Tarif unitaitre</th>
                            <th scope=\"col\">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope=\"row\">Plein Tarif</th>
                            <td id=\"qte_full_price\" class=\"text-center\">1</td>
                            <td id=\"one_full_price\" class=\"text-center\">16,00 €</td>
                            <td id=\"total_full_price\" class=\"text-center\"></td>
                            </tr>
                            <tr>
                            <th scope=\"row\">Tarif enfant</th>
                            <td id=\"qte_child_price\" class=\"text-center\">4</td>
                            <td id=\"one_child_price\" class=\"text-center\">8,00 €</td>
                            <td id=\"total_child_price\" class=\"text-center\"></td>
                            </tr>
                            <tr>
                            <th scope=\"row\">Tarif bébé</th>
                            <td id=\"qte_baby_price\" class=\"text-center\">2</td>
                            <td id=\"one_baby_price\" class=\"text-center\">0,00 €</td>
                            <td id=\"total_baby_price\" class=\"text-center\"></td>
                            </tr>
                            <th scope=\"row\">Tarif Senior</th>
                            <td id=\"qte_older_price\" class=\"text-center\">2</td>
                            <td id=\"one_older_price\" class=\"text-center\">12,00 €</td>
                            <td id=\"total_older_price\" class=\"text-center\"></td>
                            </tr>
                            <th scope=\"row\">Tarif réduit</th>
                            <td id=\"qte_discount_price\" class=\"text-center\">1</td>
                            <td id=\"one_discount_price\" class=\"text-center\">10,00 €</td>
                            <td id=\"total_discount_price\" class=\"text-center\"></td>
                            </tr>
                        </tbody>
                        <tfooter>
                            <tr>
                            <th scope=\"row\"></th>
                            <td></td>
                            <th>Total</th>
                            <td id=\"total_price\" class=\"text-center\"></td>
                            </tr>
                        </tfooter>
                    </table>
                
                <div class=\"mx-auto text-center alert alert-secondary\">
                    <input id=\"checkBox\" type=\"checkbox\"><span> En cochant cette case, vous confirmez avoir lu et accepter les <a href=\"#\">conditions générales d'utilisation</a></span>
                </div>
                
                <div class=\"mx-auto \">
                    <input id=\"button_submit\" class=\"btn btn-info btn-lg btn-block\" type=\"submit\" value=\"Poursuivre\">
                </div>
            </div>
        </div>
    </div> 

";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 97
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        // line 98
        echo " ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

<script>
\$(function(){


    \$('#drdoh_ticketbundle_guest_birthDate_month').change(function(){
        console.log(
            \$('#drdoh_ticketbundle_guest_birthDate_month, option').val()
        )   
    }); 
    \$('#drdoh_ticketbundle_guest_birthDate_day').change(function(){
        console.log(
            \$('#drdoh_ticketbundle_guest_birthDate_day').val()
        )   
    }); 
    \$('#drdoh_ticketbundle_guest_birthDate_year').change(function(){
        console.log(
            \$('#drdoh_ticketbundle_guest_birthDate_year').val()
        )   
    }); 

    \$('#drdoh_ticketbundle_guest_discountType').change(function(){
        console.log(
            \$('#drdoh_ticketbundle_guest_discountType').val()
        )   
    }); 
        




})

</script>

";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "DrDohTicketBundle:Default:guestForm.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  195 => 98,  186 => 97,  101 => 21,  93 => 16,  86 => 14,  78 => 8,  69 => 7,  57 => 4,  46 => 3,  15 => 1,);
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
   
        <div class=\"card text-white bg-dark mb-3\">
            <h3 class=\"card-header text-center\">
            <em>
                Vous prevoyez une visite pour la {{app.request.request.get(\"choix\")}} du {{app.request.request.get(\"date\")}} <br>
                <br>
                Indiquez vos coordonnées pour la reservation de {{app.request.request.get(\"ticket_qte\")}} billet(s).  
            <em>
            </h3>
            <div class=\"card-body\">
                <div class=\"well\">
                    {{form(form)}}

                </div>
            </div>
        </div>

        <br>
        
        <div class=\"card text-white bg-dark mb-3\">
            <h3 class=\"card-header text-center\">
                Montant de votre commande
            </h3>
            <div class=\"card-body\">
                <div class=\"well text-dark\">
                    <table class=\"table table-striped table-light table-bordered\">
                        <thead>
                            <tr>
                            <th scope=\"col\">Billets</th>
                            <th scope=\"col\">Quantité</th>
                            <th scope=\"col\">Tarif unitaitre</th>
                            <th scope=\"col\">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope=\"row\">Plein Tarif</th>
                            <td id=\"qte_full_price\" class=\"text-center\">1</td>
                            <td id=\"one_full_price\" class=\"text-center\">16,00 €</td>
                            <td id=\"total_full_price\" class=\"text-center\"></td>
                            </tr>
                            <tr>
                            <th scope=\"row\">Tarif enfant</th>
                            <td id=\"qte_child_price\" class=\"text-center\">4</td>
                            <td id=\"one_child_price\" class=\"text-center\">8,00 €</td>
                            <td id=\"total_child_price\" class=\"text-center\"></td>
                            </tr>
                            <tr>
                            <th scope=\"row\">Tarif bébé</th>
                            <td id=\"qte_baby_price\" class=\"text-center\">2</td>
                            <td id=\"one_baby_price\" class=\"text-center\">0,00 €</td>
                            <td id=\"total_baby_price\" class=\"text-center\"></td>
                            </tr>
                            <th scope=\"row\">Tarif Senior</th>
                            <td id=\"qte_older_price\" class=\"text-center\">2</td>
                            <td id=\"one_older_price\" class=\"text-center\">12,00 €</td>
                            <td id=\"total_older_price\" class=\"text-center\"></td>
                            </tr>
                            <th scope=\"row\">Tarif réduit</th>
                            <td id=\"qte_discount_price\" class=\"text-center\">1</td>
                            <td id=\"one_discount_price\" class=\"text-center\">10,00 €</td>
                            <td id=\"total_discount_price\" class=\"text-center\"></td>
                            </tr>
                        </tbody>
                        <tfooter>
                            <tr>
                            <th scope=\"row\"></th>
                            <td></td>
                            <th>Total</th>
                            <td id=\"total_price\" class=\"text-center\"></td>
                            </tr>
                        </tfooter>
                    </table>
                
                <div class=\"mx-auto text-center alert alert-secondary\">
                    <input id=\"checkBox\" type=\"checkbox\"><span> En cochant cette case, vous confirmez avoir lu et accepter les <a href=\"#\">conditions générales d'utilisation</a></span>
                </div>
                
                <div class=\"mx-auto \">
                    <input id=\"button_submit\" class=\"btn btn-info btn-lg btn-block\" type=\"submit\" value=\"Poursuivre\">
                </div>
            </div>
        </div>
    </div> 

{% endblock %}

{% block javascripts %}
 {{parent()}}

<script>
\$(function(){


    \$('#drdoh_ticketbundle_guest_birthDate_month').change(function(){
        console.log(
            \$('#drdoh_ticketbundle_guest_birthDate_month, option').val()
        )   
    }); 
    \$('#drdoh_ticketbundle_guest_birthDate_day').change(function(){
        console.log(
            \$('#drdoh_ticketbundle_guest_birthDate_day').val()
        )   
    }); 
    \$('#drdoh_ticketbundle_guest_birthDate_year').change(function(){
        console.log(
            \$('#drdoh_ticketbundle_guest_birthDate_year').val()
        )   
    }); 

    \$('#drdoh_ticketbundle_guest_discountType').change(function(){
        console.log(
            \$('#drdoh_ticketbundle_guest_discountType').val()
        )   
    }); 
        




})

</script>

{% endblock %}

    
", "DrDohTicketBundle:Default:guestForm.html.twig", "/Applications/MAMP/htdocs/Projet4/src/DrDoh/TicketBundle/Resources/views/Default/guestForm.html.twig");
    }
}
