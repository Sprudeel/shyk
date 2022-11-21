# Permissionslist

Concept for Permissions

Permissions are grouped to blocks (ex. Roles), each Permission of a Role starts with their GroupID (ex. roles_view has the ID 210)

-   **\_view** ends in 10
-   **\_create** ends in 20
-   **\_update** ends in 30
-   **\_delete** ends in 40
-   **\_report** ends in 50
-   **\_edit** ends in 60
-   **admin\_** start with 90 and then use the above rules without the 0

!! Special Permissions are in Group 900 !!

## Roles _200_

-   **roles_view** _210_ <br> Rollen anschauen
-   **roles_create** _220_ <br> Rolle erstellen
-   **roles_update** _230_ <br> Rolle bearbeiten
-   **roles_delete** _240_ <br> Rolle löschen

## Permissions _300_

-   **permission_view** _310_ <br> Berechtigungen anschauen

## User _400_

-   **user_report** _450_ <br> Kann Nutzer melden
-   **userprofile_edit_self** _461_ <br> Eigenes Nutzer Profil editieren
-   **userprofile_edit_all** _462_ <br> Alle Nutzer Profil editieren
-   **admin_view_users** _491_ <br> Nutzertabelle in Admin Sektion anzeigen
-   **admin_update_role** _493_ <br> Nutzerrollen bearbeiten

## Post _500_

-   **post_view_all** _511_ <br> Alle Posts anschauen
-   **post_create** _520_ <br> Kann Posts erstellen
-   **post_update_self** _530_ <br> Eigene Posts bearbeiten
-   **post_update_all** _531_ <br> Alle Posts bearbeiten
-   **post_delete_self** _540_ <br> Eigene Posts löschen
-   **post_delete_all** _541_ <br> Alle Posts löschen
-   **post_report** _550_ <br> Posts melden

## Special _900_

-   **view_admin_section** _901_ <br> Kann die Admin Sektion anschauen
-   **log_viewer** _920_ <br> Kann den Log Viewer benutzen
