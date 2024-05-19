import java.util.ArrayList;

public class Donnees{
    //Cette classe représente l'ensemble des données disponibles dans une table
    private Table tb; //La table dans laquelle se trouve les données que nous avons
    private ArrayList<String> contenu; // Element d'une ligne dans notre table

    public Donnees(Table t, ArrayList<String> contenu){
        this.tb=t;
        this.contenu=contenu;
    }

    public Table get_table(){
        return this.tb;
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

    public String affichage_donnee(){
        String res="";
        for (String content : this.contenu){
            res+=content+" - ";
        }
        return res;
    }

    public String affichage_interface(){
        String res="";
        for (String content : this.contenu){
            res+=content+" - \n";
        }
        return res;
    }

    public String get_first_content(){
        return this.contenu.get(0);
    }

    public void supprimerDonnee(){
        this.contenu=new ArrayList<>();
        this.tb=null;
    }
}