import java.util.ArrayList;

public class Test{

    public static void main(String[]args){
        ArrayList <String> col=new ArrayList<String>();
        col.add("Titre");
        col.add("Auteur");
        col.add("Annee de parution");
        col.add("Maison d'édition");
        Table t = new Table("Livres", 4,col);
        /*System.out.println(t.getNbColonnes());
        System.out.println(t.supprimerTable());
        System.out.println(t.getNbColonnes());*/
    }
}
