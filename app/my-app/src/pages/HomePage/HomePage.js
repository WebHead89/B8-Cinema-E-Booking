import { Card, CardActions, CardMedia, Typography, Grid, CardContent, Button } from '@mui/material'
import React from 'react'
import GlobalNavBar from '../GlobalNavBar/GlobalNavBar'

const HomePage = () => {


    return (
        // Global Navbar
        // Trailer
        // Movies
        <div>
            <GlobalNavBar />
            <Grid container direction="row" spacing={{ xs: 2, md: 3 }} columns={{ xs: 4, sm: 8, md: 12 }}
            sx={{margin: 20}}>
                {movies.map((element) => (
                    <Grid xs={2} sm={4} md={4}>
                        <Card>
                            <CardMedia component='img' heigh='140' image={element.image} />
                            <CardContent>
                                <Typography gutterBottom variant="h5" component="div">
                                    {element.title}
                                </Typography>
                                <Typography variant="body2" color="text.secondary">
                                    Rated {element.rating}
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
    { title: 'Avatar', rating: 'PG-13', image: 'link/to/img/file' },
    { title: 'Top Gun: Maverick', rating: 'PG-13', image: 'link/to/img/file' },
    { title: 'Avengers', rating: 'PG-13', image: 'link/to/img/file' }
]

export default HomePage