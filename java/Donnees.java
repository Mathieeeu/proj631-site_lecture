import java.util.ArrayList;

public class Donnees{
    //Cette classe représente l'ensemble des données disponibles dans une table
    private Table tb; //La table dans laquelle se trouve les données que nous avons
    private ArrayList<String> contenu; // Element d'une ligne dans notre table

    public Donnees(Table t, ArrayList<String> contenu){
        this.tb=t;
        this.contenu=contenu;
    }

    public ArrayList<String> getContenu(){
        return this.contenu;
    }

    public void afficherDonnee(){
        String res = "(";
        for (String content : this.contenu){
            res+=content+" ; ";
        }
        System.out.print(res+")");
    }

    public String affichage_interface(){
        String res="";
        for (String content : this.contenu){
            res+=content+" - \n";
        }
        System.out.println(res);
        return res;


    }

    public void supprimerDonnee(){
        this.contenu=new ArrayList<>();
        this.tb=null;
    }
}