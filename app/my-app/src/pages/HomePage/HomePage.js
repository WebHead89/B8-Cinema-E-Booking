import { Card, CardActions, CardMedia, Typography, Grid, CardContent, Button } from '@mui/material'
import React from 'react'
import GlobalNavBar from '../GlobalNavBar/GlobalNavBar'
import * as posters from '../../assets/moviePosters/index'
const HomePage = () => {


    return (
        // Global Navbar
        // Trailer
        // Movies
        <div>
            <GlobalNavBar />
            <Grid container direction="row" style={{ height: "250px", paddingTop: "2%" }}
                spacing={{ xs: 2, md: 3 }} columns={{ xs: 4, sm: 8, md: 12 }}
                sx={{ padding: '10%' }}>
                {movies.map((element) => (
                    <Grid xs={2} sm={4} md={4}>
                        <Card>
                            <CardMedia component='img' height='500' image={posters[element.image]} alt="test" />
                            <CardContent>
                                <Typography gutterBottom variant="h5" component="div">
                                    {element.title}
                                </Typography>
                                <Typography variant="body2" color="text.secondary">
                                    Rated {element.rating} | {element.genre}
                                </Typography>
                            </CardContent>
                            <CardActions>
                                <Button size='small' variant='contained'>Buy Tickets/View Showtimes</Button>
                            </CardActions>
                        </Card>
                    </Grid>
                ))}
            </Grid>
        </div>
    )
}

const movies = [
    { title: 'Avatar', rating: 'PG-13', image: 'AvatarPoster', genre: 'Sci-Fi, Adventure' },
    { title: 'Top Gun: Maverick', rating: 'PG-13', image: 'TopGunMaverickPoster', genre: 'Action' },
    { title: 'Avengers', rating: 'PG-13', image: 'AvengersPoster', genre: 'Action, Sci-Fi' }
]

export default HomePage